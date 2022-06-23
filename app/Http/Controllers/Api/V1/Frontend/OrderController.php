<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        $orders = Order::with('foods')->where('user_id', auth()->id())->latest()->get();
        return JsonResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\OrderRequest  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function store(OrderRequest $request)
    {
        $price = [];
        $foods = [];
        foreach($request->input('foods') as $key => $food) {
            $food = Food::whereSlug($food)->firstOrFail();
            abort_if($food->stock < $request->input('quantity.' . $key), 403, 'The quantity for ' . $food->heading . ' should maximum ' . $food->stock);
            $foods[] = [
                'food_id'   => $food->id,
                'quantity'  => $request->input('quantity.' . $key),
            ];
            $price[] = $food->price * $request->input('quantity.' . $key);
        }

        $order = Order::create([
            'user_id'   => auth()->id(),
            'price'     => array_sum($price),
            'address'   => $request->input('address'),
        ]);

        foreach ($foods as $food) {
            $order->foods()->create($food);
        }

        return JsonResource::collection($order);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Order $order)
    {
        abort_unless($order->user_id == auth()->id(), 403, __('This order does\'nt belong to you.'));
        return new JsonResource($order);
    }
}
