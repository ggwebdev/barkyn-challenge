<?php

namespace App\Services;

use App\Repositories\Contracts\CustomerRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Customer;
// use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class CustomerService {

    private $customerRepository;
    
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    
    public function getAll(){

        $customers = $this->customerRepository->getAll();
        
        $data['valid'] = true;
        $data['data']['customers'] = $customers;
        
        return response()->json($data);

    }

    public function get($id){

        $customer = $this->customerRepository->get($id);

        if($customer){

            $data['valid'] = true;
            $data['data']['customer'] = $customer;
            
        }else{

            $data['valid'] = false;
            $data['errors'] = 'Customer not found...';

        }

        return response()->json($data);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), Customer::RULE_CUSTOMER);

        if ($validator->fails()) {
            
            $data['valid'] = false;
            $data['message'] = 'Validation fails!';
            $data['errors'] = $validator->errors();

        }else{
            
            $customer = $this->customerRepository->store($request);
    
            if($customer){
    
                $data['valid'] = true;
                $data['message'] = 'Customer has been created!';
                $data['data']['customer'] = $customer;
            
            }else{
    
                $data['valid'] = false;
                $data['errors'] = 'Customer cannot be saved...';
    
            }
        }

        return response()->json($data);

    }

    public function update($id, Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'birth_date' => 'required|date|date_format:Y-m-d|before:-18 years',
            'gender' => 'required|in:male,female',
            'email' => 'required|email|unique:customers,id,'.$id
        ]);

        if ($validator->fails()) {
            
            $data['valid'] = false;
            $data['message'] = 'Validation fails!';
            $data['errors'] = $validator->errors();

        }else{

            $customer = $this->customerRepository->update($id, $request);

            if($customer){

                $data['valid'] = true;
                $data['message'] = 'Customer has been updated!';
                $data['data']['customer'] = Customer::find($id);
            
            }else{

                $data['valid'] = false;
                $data['errors'] = 'Customer cannot be updated...';

            }

        }

        return response()->json($data);

    }

    public function destroy($id){

        $customer = $this->customerRepository->get($id);
        
        if($customer){
            
            $this->customerRepository->destroy($id);
            $data['valid'] = true;
            $data['message'] = 'Customer has been deleted!';
            $data['data']['customer'] = $customer;
        
        }else{

            $data['valid'] = false;
            $data['errors'] = 'Customer not found...';

        }

        return response()->json($data, 410);

    }

    public function profile($id){

        $customer = $this->customerRepository->get($id);

        if($customer){

            $data['valid'] = true;
            $data['data']['customer'] = $customer;
            $data['data']['customer']['subscription'] = $customer->subscription;
            $data['data']['customer']['subscription']['pets'] = $customer->subscription->pets;
            
        }else{

            $data['valid'] = false;
            $data['errors'] = 'Customer not found...';

        }

        return response()->json($data);

    }

    public function subscription($id){

        $customer = $this->customerRepository->get($id);

        if($customer){

            $data['valid'] = true;
            $data['data']['customer'] = $customer;
            $data['data']['customer']['subscription'] = $customer->subscription;
            
        }else{

            $data['valid'] = false;
            $data['errors'] = 'Customer subscription not found...';

        }

        return response()->json($data);

    }

    public function pets($id){

        $customer = $this->customerRepository->get($id);

        if($customer){

            $data['valid'] = true;
            $data['data']['customer'] = $customer;
            $data['data']['customer']['pets'] = $customer->pets;
            
        }else{

            $data['valid'] = false;
            $data['errors'] = 'Customer pets not found...';

        }

        return response()->json($data);

    }

    public function dispatch($id){

        $customer = $this->customerRepository->get($id);
        
        if($customer){

            $customer->subscription()->update([
                'last_order_date' => date('Y-m-d'),
                'next_order_date' => date('Y-m-d', strtotime('+ 4 weeks'))
            ]);

            $data['valid'] = true;
            $data['message'] = 'Subscription has been dispatched!';
            $data['data']['customer'] = $customer;
            $data['data']['customer']['subscription'] = $customer->subscription;
            
        }else{

            $data['valid'] = false;
            $data['errors'] = 'Customer subscription cannot be dispatched...';
            
        }
        
        return response()->json($data);

    }

}