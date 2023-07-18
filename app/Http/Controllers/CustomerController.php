<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CustomerResource::collection(Customer::all());
    }

 

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        try{
            $customer =  Customer::create([
            'name'=>$request->name,
            'phone' => $request->phone
        ]);
           
        return CustomerResource::make($customer);
    } catch (ValidationException $e) {
        return response()->json(['message' => $e->getMessage()]);
     
        }
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return CustomerResource::make($customer);
    }

  
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        try{
            $customer->update([
            'name'=>$request->name,
            'phone' => $request->phone
        ]);
           
        return CustomerResource::make($customer);
    } catch (ValidationException $e) {
        return response()->json(['message' => $e->getMessage()]);
     
        }
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try{
            $customer->delete();  
          
          return response()->json(['message' => 'deleted success']);
      } catch (ValidationException $e) {
          return response()->json(['message' => $e->getMessage()]);
      }
      }
    }

