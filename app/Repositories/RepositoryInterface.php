<?php

namespace App\Repositories;

interface RepositoryInterface{
    public function getAll();
    public function getOne(Int $id);
    public function store(Array $data);
    public function update(Int $id, Array $data);
    public function destroy(Int $id);
}