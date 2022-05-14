<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    public function testRequiredFieldsForCategoryCreation(){
        $token =  Auth::login(User::first(), true);
       
        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('POST', 'api/categories', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "description" => ["The description field is required."]
            ]);
    }

    public function testSuccessfulCategoryCreating(){

        $token =  Auth::login(User::first(), true);

        $category = [
            "description" => "Test Category", 
            "is_active" => 1
        ];

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('POST', 'api/categories', $category, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                    'id',
                    'description',
                    'is_active',
                    'updated_at',
                    'created_at',
                ]);
    }

    public function testSuccessfulCategoryUpdate(){

        $token =  Auth::login(User::first(), true);

        $getCategory = Category::latest()->first();

        $updateInfo = [
            "description" => "Test Product 2", 
            "is_active" => 1
        ];

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('PUT', "api/categories/{$getCategory->id}", $updateInfo, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                    'id',
                    'description',
                    'is_active',
                    'updated_at',
                    'created_at',
                ]);
    }

    public function testSuccessfulDeletation(){

        $token =  Auth::login(User::first(), true);

        $getCategory = Category::latest()->first();

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('DELETE', "api/categories/{$getCategory->id}", ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "deleted" => true
            ]);
    }

    public function testUnSuccessfulDeletation(){

        $token =  Auth::login(User::first(), true);

        $categoryId = 9999; // It Doesn't exist

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('GET', "api/categories/{$categoryId}", ['Accept' => 'application/json'])
            ->assertStatus(404)
            ->assertJson([
                "message" => "No query results for model [App\\Models\\Category] {$categoryId}"
            ]);
    }
}
