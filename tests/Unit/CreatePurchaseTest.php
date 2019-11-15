<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePurchaseTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('POST', '/purchases', ['customer_name' => 'Customer Name']);
        $response->assertStatus(422);

        $response = $this->json('POST', '/purchases', ['customer_name' => 'Customer Name', 'quantity' => 0, 'offering_id' => 1]);
        $response->assertStatus(422);

        $response = $this->json('POST', '/purchases', ['customer_name' => 'Customer Name', 'quantity' => 5, 'offering_id' => 1]);
        $response->assertStatus(200);
    }
}
