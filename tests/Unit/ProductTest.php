<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_store()
    {
        $response = $this->post('/api/product', [
            'name' => 'product one',
            'description' => 'new category here',
            'price'=>'100',
            'quantity'=>200,
            'categories'=>[2,3]

        ]);
 
        $response->assertStatus(201);
    }

    public function test_update()
    {
        $response = $this->patch('/api/product/{id}', [
            'name' => 'product one',
            'description' => 'new category here',
            'price'=>'100',
            'quantity'=>200,
            'categories'=>[2,3]
        ]);
 
        $response->assertStatus(201);
    }

    public function test_destroy()
    {
        $response = $this->delete('/api/product/{id}');
 
        $response->assertStatus(201);
    }
}
