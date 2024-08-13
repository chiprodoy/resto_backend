<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    public $endPointURL='/api/product';
    /**
     * A basic feature test example.
     */
    public function test_product_endpoint_cannot_access_by_guest(): void
    {
        $response = $this->getJson($this->endPointURL);
       // dd($response->decodeResponseJson());

        $response->assertStatus(401);
    }

    /**
     * A basic feature test example.
     */
    public function test_get_all_product(): void
    {
        Sanctum::actingAs(
            User::first(),
        );

        $response = $this->getJson($this->endPointURL);
       // dd($response->decodeResponseJson());

        $response->assertStatus(200)->assertJsonStructure(['data'=>[['id', 'uuid','product_name','price']]]);
    }

        /**
     * A basic feature test example.
     */
    public function test_show_detail_product(): void
    {
        Sanctum::actingAs(
            User::first(),
        );

        $product=Product::first();

        $response = $this->getJson(route('product.show',$product->uuid));
        //dd($response->decodeResponseJson());
       $response->assertStatus(200)
       ->assertJson(fn (AssertableJson $json) =>
        $json->has('data')
           ->has('data',  fn ($json) =>
                   $json->where('id', $product->id)
                        ->where('uuid', $product->uuid)
                        ->where('product_name',$product->product_name)
                        ->etc()
                )
       );
        //$response->assertStatus(200)->assertJsonStructure(['data'=>['id', 'uuid','product_name','price']]);
    }
}
