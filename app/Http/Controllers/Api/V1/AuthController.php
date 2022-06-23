<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends Controller
{

    /**
     * @param   \App\Http\Requests\RegisterRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $request->merge(['password' => bcrypt($request->input('password'))]);
        $user = User::create($request->only(['name', 'email', 'password']));

        $accessToken = $user->createToken('userToken')->accessToken;
        return response()->json([
            'user'          => new UserResource($user),
            'token'         => $accessToken,
            'token_type'    => 'Bearer'
        ]);
    }

    /**
     * @param  \App\Http\Requests\LoginRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $user = User::whereEmail($request->input('email'))->firstOrFail();

        if (!auth()->attempt($request->all())) {
            return response()->json(__('The email or password is wrong!'), 422);
        }
        $user           = auth()->user();
        $tokenResult    = $user->createToken('userToken');
        $tokenModel     = $tokenResult->token;
        if ($request->remember_me) {
            $tokenModel->expires_at = Carbon::now()->addWeeks(1);
        }
        $tokenModel->save();
        return response()->json([
            'user'          => new UserResource($user),
            'token'         => $tokenResult->accessToken,
            'token_type'    => 'Bearer'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(__('You have been successfully logout.'));
    }
}
