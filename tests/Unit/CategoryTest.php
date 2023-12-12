<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    use RefreshDatabase;
 
    
 
    public function test_store()
    {
        $response = $this->post('/api/category', [
            'name' => 'category one',
            'description' => 'new category here'
        ]);
 
        $response->assertStatus(201);
    }

    public function test_update()
    {
        $response = $this->patch('/api/category/{id}', [
            'name' => 'category one',
            'description' => 'new category here'
        ]);
 
        $response->assertStatus(201);
    }

    public function test_destroy()
    {
        $response = $this->delete('/api/category/{id}');
 
        $response->assertStatus(201);
    }
}
