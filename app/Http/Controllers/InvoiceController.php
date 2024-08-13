<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $invoiceModel = Invoice::orderBy('id','desc');

        if(!empty($request->status_pembayaran)){
            $invoiceModel->where('status_pembayaran',$request->status_pembayaran);
        }

        if(!empty($request->meja_id)){
            $invoiceModel->where('meja_id',$request->meja_id);
        }

        $data = $invoiceModel->get();
        return InvoiceResource::collection($data);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $invoice_number)
    {
        $invoice = Invoice::where('invoice_number',$invoice_number)->first();
        return new InvoiceResource($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
