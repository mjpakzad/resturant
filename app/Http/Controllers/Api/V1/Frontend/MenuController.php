<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        $menus = Menu::get();
        return JsonResource::collection($menus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return  \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Menu $menu)
    {
        return new JsonResource($menu);
    }
}
