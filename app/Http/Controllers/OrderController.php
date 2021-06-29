<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $orders = [];
        if ($this->user->hasRole('admin'))
            $orders = Order::query();
        else
            $orders = $this->user->orders();
        return OrderResource::collection($orders->search($request)->paginate($request->per_page ?? 10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Order::$createRules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $order = Order::create($validator->validated());
        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if ($this->user->owns($order) || $this->user->hasRole('admin'))
            return new OrderResource($order);
        return response()->json(['error' => 'not_permitted'], 422);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(), Order::$createRules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $order = Order::create($validator->validated()['data']);
        $order->purchases()->saveMany(Purchase::insert($validator->validated()['items']));
        return new OrderResource($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return new OrderResource($order);
    }
}
