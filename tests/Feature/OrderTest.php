<?php

namespace Tests\Feature;

use App\Models\Meja;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class OrderTest extends TestCase
{

    public $product;

    public function setProduct(){
        $merchant = Merchant::find(1);

        $product = Product::where('merchant_id',$merchant->id)->first();

        $meja = Meja::where('merchant_id',$merchant->id)->first();


        $this->product=[
            'product_id'=>$product->id,
            'item_name'=>$product->product_name,
            'satuan'=>$product->satuan,
            'price'=>$product->price,
            'qty'=>1,
            'meja_id'=> $meja->id
        ];
    }
    public function test_waiters_can_make_order(){
        $role = Role::where('role_name','waiter')->first();
        $user = $role->users()->with('merchants')->first();
        //dd($user);
        Sanctum::actingAs(
            $user
        );

        $this->setProduct();
        $response = $this->post('/api/order',$this->product);

        //dd($response->decodeResponseJson());

        $response->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
        $json->has('data')
           ->has('data',  fn ($json) =>
                   $json->where('item_name', $this->product['item_name'])
                   ->where('meja_id',$this->product['meja_id'])
                   ->where('status_order','inorder')
                   ->etc()
                )
       );
    }

    public function test_waiters_can_send_order_to_kitchen_and_make_invoice(){
        $role = Role::where('role_name','waiter')->first();
        $user = $role->users()->first();
        $merchant = $user->merchants[0];

        Sanctum::actingAs(
            $user
        );

        $this->setProduct();

        $orderHttpRequest = $this->getJson(route('order.index').'?status_order=inorder&meja_id='.$this->product['meja_id']);
        $result = $orderHttpRequest->json();
        $order = $result['data'];

        foreach($order as $k => $v){
            $responseInvoiceItem = $this->postJson(route('invoice_item.store'),
                [
                    'meja_id'=>$v['meja_id'],
                    //'merchant_uuid'=>$merchant->uuid
                ]
            );
            $responseOrder=$this->getJson(route('order.show',$v['uuid']));
        }
        //dd($responseInvoiceItem->decodeResponseJson());

        $invoiceItem=$responseInvoiceItem->json();
        $invoiceItemData=$invoiceItem['data'];

        $invoiceRespon = $this->getJson(route('invoice.show',$invoiceItemData[0]['invoice']['invoice_number']));

        $responseInvoiceItem->assertStatus(200);

        $responseOrder->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
            $json->has('data')
               ->has('data',  fn ($json) => $json->where('item_name', $order[0]['item_name'])
                   ->where('product_id',$order[0]['product_id'])
                   ->where('meja_id',$order[0]['meja_id'])
                   ->where('status_order','cooking')
                   ->etc()
                )
        );
    }
    public function test_order_item_count_with_status_invoice_same_as_invoice_item_count(): void
    {
        $role = Role::where('role_name','kasir')->first();
        $user = $role->users()->first();
        $merchant = $user->merchants[0];

        Sanctum::actingAs(
            $user
        );

        $this->setProduct();

        $orderHttpRequest = $this->getJson(route('order.index').'?status_order=cooking&meja_id='.$this->product['meja_id']);
        $result = $orderHttpRequest->json();
        $order = $result['data'];

        $invoiceHttpRequest = $this->getJson(route('invoice.index').'?meja_id='.$this->product['meja_id']);
        $invoiceResult = $invoiceHttpRequest->json();
        $invoice = $invoiceResult['data'][0];

        assertTrue(count($order)==count($invoice['invoice_item']));

    }

    public function test_waiters_can_decrement_order(){
        $role = Role::where('role_name','waiter')->first();
        $user = $role->users()->with('merchants')->first();
        //dd($user);
        Sanctum::actingAs(
            $user
        );

        $this->setProduct();
        $response = $this->deleteJson('/api/order/1',
            [
              'product'=>$this->product['product_id'],
              'meja'=>$this->product['meja_id']
            ]
        );

       // dd($response->decodeResponseJson());

        $response->assertStatus(200);
    }

    public function test_kitchen_can_set_status_order_from_cooking_to_invoice(){
        $role = Role::where('role_name','dapur')->first();
        $user = $role->users()->first();
        $merchant = $user->merchants[0];

        Sanctum::actingAs(
            $user
        );

        $this->setProduct();

        $orderHttpRequest = $this->getJson(route('order.index').'?status_order=cooking');
        $result = $orderHttpRequest->json();
        $order = $result['data'];

        $responseOrder = $this->postJson(route('order.update.status',['id'=>$order[0]['uuid'],'status'=>'invoice']));
        //dd($responseInvoiceItem->decodeResponseJson());

        $responseOrder->assertStatus(200);
    }
    /**
     * A basic feature test example.
     */
    /**
    public function test_show_all_order(): void
    {
        $role = Role::where('role_name','owner')->first();
        $user = $role->users()->first();
        //dd($user);
        Sanctum::actingAs(
            $user
        );

        $response = $this->get('/api/order');
        dd($response->decodeResponseJson());
       $response->assertStatus(200);
    }
    */
    /**
     * A basic feature test example.
     */
    /**
    public function test_show_all_order_with_status_inorder(): void
    {

        $response = $this->get('/api/order?status_order=inorder');

        $response->assertStatus(200) ->assertJson(fn (AssertableJson $json) =>
        $json->has('data')
           ->has('data',  fn ($json) =>
                   $json->whereNot('status_order', 'invoice')
                   ->etc()
                )
       );
    }
*/
    /**
    public function test_waiters_can_see_order_with_status_inorder(): void
    {

    }

    public function test_waiters_can_not_see_order_with_status_cooking(): void
    {

    }

    public function test_waiters_can_not_see_order_with_status_invoice(): void
    {

    }

    public function test_dapur_can_see_order_with_status_cooking(): void
    {

    }

    public function test_dapur_can_not_see_order_with_status_invoice(): void
    {

    }
    public function test_kasir_can_see_order_with_status_invoice(): void
    {

    }

    public function test_waiters_can_change_order_status_to_cooking(): void
    {

    }
    public function test_dapur_can_change_order_status_to_invoice(): void
    {

    }

    public function test_waiters_cannot_change_order_status_from_cooking_to_inorder(): void
    {

    }

    public function test_waiters_cannot_change_order_status_from_invoice_to_inorder(): void
    {

    }
    */
}
