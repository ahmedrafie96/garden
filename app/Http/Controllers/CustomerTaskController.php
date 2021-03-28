<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Customer;

class CustomerTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Customer $customer)
    {
        //
        return CustomerResource::collection(Customer::search($request)->paginate($request->per_page??10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(),Task::$createRules);
        if($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()
            ],402);
        }
        $task = Task::create($validator->validated());
        $customer->tasks()->save($task);
        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer, Task $task)
    {
        //
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer, Task $task)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($task)){
            $validator = Validator::make($request->all(),Task::$updateRules);
            $task->update($validator->validated());
            return new TaskResource($task);
        }
        return response()->json([
            'errors'=>[],
            'message'=> 'forbidden'
        ],403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer, Task $task)
    {
        //
        if($this->user->hasRole("admin") || $this->user->owns($task)){
            $task->delete();
            return new TaskResource($task);
        }
        return response()->json([
            'errors'=>[],
            'message'=> 'forbidden'
        ],403);
    }
}
