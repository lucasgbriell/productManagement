<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository implements RepositoryInterface{

    const PAGINATION = 10;

    public function getOne(Int $id){
        return Category::findOrFail($id);
    }

    public function getAll(){
        return Category::latest()->paginate(self::PAGINATION);
    }

    public function store(Array|Object $data){
        return Category::create($data);
    }

    public function update(Int $id, Array|Object $data){
        $updateCategory = $this->getOne($id);
        $updateCategory->update($data);
        return $updateCategory;
    }
     
    public function destroy($id){
        return $this->getOne($id)->delete();
    }
}