<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SubscriptionService;

class SubscriptionController extends Controller
{
    private $subscriptionService;
    
    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function index(){
        return $this->subscriptionService->getAll();
    }

    public function show($id){
        return $this->subscriptionService->get($id);
    }

    public function store(Request $request){
        return $this->subscriptionService->store($request);
    }

    public function update($id, Request $request){
        return $this->subscriptionService->update($id, $request);
    }

    public function destroy($id){
        return $this->subscriptionService->destroy($id);
    }

    public function pets($id){
        return $this->subscriptionService->pets($id);
    }
    
    public function dispatch($id){
        return $this->subscriptionService->dispatch($id);
    }
    

}
