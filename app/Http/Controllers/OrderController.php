<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($status=null)
    {
        $orderModel = Order::orderBy('id','desc');

        if(!empty($status)){
            $orderModel::where('status_order',$status);
        }
        return OrderResource::collection($orderModel->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
            // Retrieve the validated input data...
        $validated = $request->validated();

        $order = Order::create([
            'item_name'=>$validated->item_name,
            'satuan'=>$validated->satuan,
            'price'=>$validated->price,
            'qty'=>$validated->qty,
            'meja_id'=>$validated->meja_id,
           // 'status_order'=>$validated->status_order
        ]);

        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $order = Order::where('uuid',$uuid)->get();
        return new OrderResource($order);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validated();

        $order = Order::create([
            'item_name'=>$validated->item_name,
            'satuan'=>$validated->satuan,
            'price'=>$validated->price,
            'qty'=>$validated->qty,
            'meja_id'=>$validated->meja_id,
           // 'status_order'=>$validated->status_order
        ]);

        return new OrderResource($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
