<?php

namespace App\Repositories\Contracts;
use Illuminate\Http\Request;

interface PetRepositoryInterface {

    public function getAll();
    public function get($id);
    public function store(Request $request);
    public function update($id, Request $request);
    public function destroy($id);

}
