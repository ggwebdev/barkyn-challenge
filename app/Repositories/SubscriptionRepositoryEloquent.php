<?php

namespace App\Repositories;

use App\Repositories\Contracts\SubscriptionRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionRepositoryEloquent implements SubscriptionRepositoryInterface {

    private $model;

    public function __construct(Subscription $subscription){
        $this->model = $subscription;
    }

    public function getAll(){
        return $this->model->all();
    }

    public function get($id){
        return $this->model->find($id);
    }

    public function getBy($key, $value){
        return $this->model->where($key, $value)->first();
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