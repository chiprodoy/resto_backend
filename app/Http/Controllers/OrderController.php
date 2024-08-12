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
    public function index(Request $request)
    {
        $orderModel = Order::orderBy('id','desc');

        if(!empty($request->status_order)){
            $orderModel->where('status_order',$request->status_order);
        }

        if(!empty($request->meja_id)){
            $orderModel->where('meja_id',$request->meja_id);
        }

        $data = $orderModel->get();
        return OrderResource::collection($data);
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
        $validated['uuid'] = '-';
        $validated['status_order'] = 'inorder';

        $order = Order::create($validated);

        return (new OrderResource($order))->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $order = Order::where('uuid',$uuid)->first();
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
