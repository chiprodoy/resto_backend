<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_show_all_order(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_show_order_with_status_inorder(): void
    {

    }

    public function test_show_order_with_status_cooking(): void
    {

    }
    public function test_show_order_with_status_invoice(): void
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
}
