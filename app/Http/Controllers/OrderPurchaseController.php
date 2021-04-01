<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Order;
use App\Models\Task;

class OrderPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Order $order)
    {
        //
        return OrderResource::collection(Order::search($request)->paginate($request->per_page ?? 10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {
        if ($this->user->owns($order) || $this->user->hasRole('admin')) {

            $validator = Validator::make($request->all(), Purchase::$createRules);
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 402);
            }
            $purchase = Purchase::create($validator->validated());
            $order->purchases()->save($purchase);
            $task_validator = Validator::make($request->all(), Task::$createRules);
            if (!$task_validator->fails()) {
                $task = Task::create($task_validator->validated()['location']);
                $task->customer()->save($order->customer);
                $purchase->task()->save($task);
            }
            return new PurchaseResource($purchase);
        }
        return response()->json(['error' => 'not_permitted'], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order, Purchase $purchase)
    {
        //
        if ($this->user->owns($order) || $this->user->hasRole('admin'))
            return new PurchaseResource($purchase);
        return response()->json(['error' => 'not_permitted'], 422);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order, Purchase $purchase)
    {
        //
        if ($this->user->hasRole("admin") || $this->user->owns($purchase)) {
            $validator = Validator::make($request->all(), Purchase::$updateRules);
            $purchase->update($validator->validated());
            return new PurchaseResource($purchase);
        }
        return response()->json([
            'errors' => [],
            'message' => 'forbidden'
        ], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order, Purchase $purchase)
    {
        //
        if ($this->user->hasRole("admin") || $this->user->owns($purchase)) {
            $purchase->delete();
            return new PurchaseResource($purchase);
        }
        return response()->json([
            'errors' => [],
            'message' => 'forbidden'
        ], 403);
    }
}
