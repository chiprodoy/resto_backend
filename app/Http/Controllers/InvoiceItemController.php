<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceItemRequest;
use App\Http\Resources\InvoiceItemResource;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(InvoiceItemRequest $request)
    {
        /**
         * set status order ke cooking
         * cek jika invoice yang belum dibayar berdasarkan meja
         * jika ada invoice yang belum dibayar berdasarkan meja, maka gunakan invoice yang sudah dibuat
         * jika tidak ada invoice yang belum dibayar berdasarkan meja maka buat invoice baru
         * masukkan invoice item
         * update refresh invoice
        **/

        $validated = $request->validated();

        $merchant = Auth::user()->merchants()->where('uuid',$validated['merchant_uuid'])->first();

        Order::where('uuid',$validated['order_uuid'])->update(['status_order'=>'cooking']);

        $invoice = Invoice::where('meja_id',$validated['meja_id'])
        ->where('status_pembayaran','belumlunas')
        ->first();

        if(!$invoice){
            $invoice=Invoice::create([
                'uuid'=>'-',
                'invoice_number'=>'-',
                'merchant_id'=>$merchant->id,
                'meja_id'=>$validated['meja_id']
            ]);
        }

        $order = Order::where('uuid',$validated['order_uuid'])
        ->where('status_order','cooking')
        ->first();

        $invoiceItem =    InvoiceItem::create(
                [   'invoice_id'=>$invoice->id,
                    'product_id'=>$order->product_id,
                    'item_name'=>$order->item_name,
                    'satuan'=>$order->satuan,
                    'price'=>$order->price,
                    'qty'=>$order->qty,
                    'total_price'=>$order->price*$order->qty,
                    'order_id'=>$order->id
                ]
            );

            Order::where('product_id',$order->product_id)
            ->where('meja_id',$validated['meja_id'])->update(['status_order'=>'invoice']);

            return (new InvoiceItemResource($invoiceItem))->response()->setStatusCode(200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
