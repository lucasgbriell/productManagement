<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProductTest extends TestCase
{
    
    public function testRequiredFieldsForProductCreation(){

        $token =  Auth::login(User::first(), true);

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('POST', 'api/products', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "description" => ["The description field is required."],
                "code" => ["The code field is required."],
                "reference" => ["The reference field is required."],
                "quantity" => ["The quantity field is required."],
                "price" => ["The price field is required."]
            ]);
    }

    public function testSuccessfulProductCreating(){
        
        $token =  Auth::login(User::first(), true);

        $product = [
            "description" => "Test Product", 
            "code" => "Test Code", 
            "reference" => "Test Reference", 
            "quantity" => 1, 
            "price" => 1.00, 
            "is_active" => 1,
            "dimension" => []
        ];

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('POST', 'api/products', $product, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                    'id',
                    'description',
                    'code',
                    'reference',
                    'quantity',
                    'price',
                    'is_active',
                    'dimension',
                    'updated_at',
                    'created_at',
                ]);
    }

    public function testSuccessfulProductUpdate(){

        $token =  Auth::login(User::first(), true);

        $getProduct = Product::latest()->first();

        $updateInfo = [
            "description" => "Test Product 2", 
            "code" => "Test Code", 
            "reference" => "Test Reference", 
            "quantity" => 1, 
            "price" => 1.00, 
            "is_active" => 1,
            "dimension" => []
        ];

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('PUT', "api/products/{$getProduct->id}", $updateInfo, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                    'id',
                    'description',
                    'code',
                    'reference',
                    'quantity',
                    'price',
                    'is_active',
                    'dimension',
                    'updated_at',
                    'created_at',
                ]);
    }

    public function testSuccessfulDeletation(){

        $token =  Auth::login(User::first(), true);

        $getProduct = Product::latest()->first();

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('DELETE', "api/products/{$getProduct->id}", ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "deleted" => true
            ]);
    }

    public function testUnSuccessfulDeletation(){

        $token =  Auth::login(User::first(), true);

        $productId = 9999; // It Doesn't exist

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('GET', "api/products/{$productId}", ['Accept' => 'application/json'])
            ->assertStatus(404)
            ->assertJson([
                "message" => "No query results for model [App\\Models\\Product] {$productId}"
            ]);
    }
}
