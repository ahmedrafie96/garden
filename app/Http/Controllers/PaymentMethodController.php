<?php

namespace App\Http\Controllers;

use App\Http\Resources\MethodResource;
use App\Http\Resources\PaymentResource;
use App\Models\Method;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Payment;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Payment $payment)
    {
        //
        return PaymentResource::collection(Payment::search($request)->paginate($request->per_page??10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Payment $payment)
    {
        $validator = Validator::make($request->all(),Method::$createRules);
        if($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()
            ],402);
        }
        $method = Method::create($validator->validated());
        $payment->methods()->save($method);
        return new MethodResource($method);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @param  \App\Models\Method  $method
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment, Method $method)
    {
        //
        return new MethodResource($method);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @param  \App\Models\Method  $method
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment, Method $method)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($method)){
            $validator = Validator::make($request->all(),Method::$updateRules);
            $method->update($validator->validated());
            return new MethodResource($method);
        }
        return response()->json([
            'errors'=>[],
            'message'=> 'forbidden'
        ],403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @param  \App\Models\Method  $method
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment, Method $method)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($method)){
            $method->delete();
            return new MethodResource($method);
        }
        return response()->json([
            'errors'=>[],
            'message'=> 'forbidden'
        ],403);
    }
}
