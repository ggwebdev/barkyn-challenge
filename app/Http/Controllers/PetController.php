<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PetService;

class PetController extends Controller
{
    
    private $petService;
    
    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    public function index(){
        return $this->petService->getAll();
    }

    public function show($id){
        return $this->petService->get($id);
    }

    public function store(Request $request){
        return $this->petService->store($request);
    }

    public function update($id, Request $request){
        return $this->petService->update($id, $request);
    }

    public function destroy($id){
        return $this->petService->destroy($id);
    }

}
