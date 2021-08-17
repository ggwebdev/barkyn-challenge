<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerService;

class CustomerController extends Controller
{

    private $customerService;
    
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(){
        return $this->customerService->getAll();
    }

    public function show($id){
        return $this->customerService->get($id);
    }

    public function store(Request $request){
        return $this->customerService->store($request);
    }

    public function update($id, Request $request){
        return $this->customerService->update($id, $request);
    }

    public function destroy($id){
        return $this->customerService->destroy($id);
    }

    public function profile($id){
        return $this->customerService->profile($id);
    }

    public function subscription($id){
        return $this->customerService->subscription($id);
    }

    public function pets($id){
        return $this->customerService->pets($id);
    }

    public function dispatch($id){
        return $this->customerService->dispatch($id);
    }

}
