<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductApiTest extends TestCase
{

    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        factory(\App\Models\Product::class)->create(['description'=> 'product teste']);
        factory(\App\Models\Product::class)->create();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAll()
    {

        $response = $this->json('GET', '/api/product/');

        $response->assertStatus(200)
            ->assertJsonCount(2);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreate()
    {

        $response = $this->json('POST', '/api/product/', [
            'description' => "Product Created",
            'ean' => '67627262',
            'price' => 55.44
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['description' => 'Product Created']);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdated()
    {
        $product = factory(\App\Models\Product::class)->create(['description'=> 'product new']);

        $response = $this->json('PATCH', '/api/product/' . $product->id, [
            'description' => "Product Updated",
        ]);

        $response->assertStatus(200)
            ->assertJson(['success'=> 'updated']);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetOne()
    {
        $product = factory(\App\Models\Product::class)->create(['description'=> 'product new']);

        $response = $this->json('GET', '/api/product/' . $product->id);

        $response->assertStatus(200)
            ->assertJson(['description'=> 'product new']);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDelete()
    {
        $product = factory(\App\Models\Product::class)->create(['description'=> 'product delete']);

        $response = $this->json('DELETE', '/api/product/' . $product->id);

        $response->assertStatus(200)
            ->assertJson(["success" => "Deletado"]);
    }
}
