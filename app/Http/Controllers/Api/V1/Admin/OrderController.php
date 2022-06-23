<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
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
        $orders = Order::with('foods')->latest()->get();
        return JsonResource::collection($orders);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Order $order):JsonResource
    {
        return new JsonResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\OrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return  \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(OrderRequest $request, Order $order):JsonResource
    {
        $order->update(['status', $request->input('status')]);
        return new JsonResource($order);
    }
}
