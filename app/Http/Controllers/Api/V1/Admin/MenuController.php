<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MenuRequest  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(MenuRequest $request) : JsonResource
    {
        $menu = Menu::create($request->only(['heading', 'slug']));
        return new JsonResource($menu);
    }
}
