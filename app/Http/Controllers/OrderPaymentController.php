<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Order;

class OrderPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('authorizor:admin', ['except' => ['index', 'show']]);
    }
    public function index(Request $request, Order $order)
    {
        //
        if ($this->user->owns($order) || $this->user->hasRole('admin'))
            return OrderResource::collection($order->payments()->search($request)->paginate($request->per_page ?? 10));
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
            $validator = Validator::make($request->all(), Payment::$createRules);
            $card_token = $request->card_token;
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 402);
            }
            $payment = Payment::create($validator->validated());
            $order->payments()->save($payment);
            if ($card_token) {
                $payment->confirm($card_token);
            }
            return new PaymentResource($payment);
        }
        return response()->json(['error' => 'not_permitted'], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order, Payment $payment)
    {
        //
        if ($this->user->owns($order) || $this->user->hasRole('admin'))
            return new PaymentResource($payment);
        return response()->json(['error' => 'not_permitted'], 422);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order, Payment $payment)
    {
        //
        if ($this->user->hasRole("admin") || $this->user->owns($payment)) {
            $validator = Validator::make($request->all(), Payment::$updateRules);
            $payment->update($validator->validated());
            return new PaymentResource($payment);
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
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order, Payment $payment)
    {
        //
        if ($this->user->hasRole("admin") || $this->user->owns($payment)) {
            $payment->delete();
            return new PaymentResource($payment);
        }
        return response()->json([
            'errors' => [],
            'message' => 'forbidden'
        ], 403);
    }
}
