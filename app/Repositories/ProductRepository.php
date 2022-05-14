<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements RepositoryInterface{

    const PAGINATION = 10;

    public function getOne(Int $id){
        return Product::with(['category', 'dimension'])->findOrFail($id);
    }

    public function getAll(){
        return Product::with(['category', 'dimension'])->latest()->paginate(self::PAGINATION);
    }

    public function store(Array|Object $data){

        $newProduct = Product::create($data);

        foreach($data['dimension'] as $dimensions){
            $dimensions['product_id'] = $newProduct->id;
            $newProduct->dimension()->create($dimensions);
        }

        return $newProduct->load('dimension');
    }

    public function update(Int $id, Array|Object $data){
        $product = $updateProduct =  $this->getOne($id);
        $updateProduct->update($data);
        $product->dimension()->delete();

        foreach($data['dimension'] ?? [] as $dimension){
            $dimensions['product_id'] = $product->id;
            $product->dimension()->create($dimension);
        }

        return $product->load('dimension');
    }
    
    public function destroy($id){
        return $this->getOne($id)->delete();
    }
}