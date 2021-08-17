<?php

namespace App\Repositories\Contracts;
use Illuminate\Http\Request;

interface SubscriptionRepositoryInterface {

    public function getAll();
    public function get($id);
    public function getBy($key, $value);
    public function store(Request $request);
    public function update($id, Request $request);
    public function destroy($id);

}
