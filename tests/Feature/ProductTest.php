<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
public function test_get_products()
{
    $product = $this->get('api/products');

    $product->assertStatus(200);
}

public function test_get_single_product()
{

    $product = $this->get("api/products/3");

    $product->assertStatus(200);
}


}
