<?php

namespace App\Repositories;

use App\Repositories\Contracts\PetRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Pet;

class PetRepositoryEloquent implements PetRepositoryInterface {

    private $model;

    public function __construct(Pet $pet){
        $this->model = $pet;
    }

    public function getAll(){
        return $this->model->all();
    }

    public function get($id){
        return $this->model->find($id);
    }

    public function store(Request $request){
        return $this->model->create($request->all());
    }

    public function update($id, Request $request){
        return $this->model->find($id)->update($request->all());
    }

    public function destroy($id){
        return $this->model->find($id)->delete();
    }

}