<?php

namespace App\Services;

use App\Repositories\Contracts\SubscriptionRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Validator;

class SubscriptionService {

    private $subscriptionRepository;
    
    public function __construct(SubscriptionRepositoryInterface $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }
    
    public function getAll(){

        $subscriptions = $this->subscriptionRepository->getAll();
        
        $data['valid'] = true;
        $data['data']['subscriptions'] = $subscriptions;
        
        return response()->json($data);

    }

    public function get($id){

        $subscription = $this->subscriptionRepository->get($id);

        if($subscription){

            $data['valid'] = true;
            $data['data']['subscription'] = $subscription;
            
        }else{

            $data['valid'] = false;
            $data['errors'] = 'Subscription not found...';

        }

        return response()->json($data);

    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'base_price'        => 'required|numeric|between:20,45',
            'total_price'       => 'required|numeric|between:17,45',
            'next_order_date'   => 'required|date|date_format:Y-m-d|after_or_equal:tomorrow',
        ]);

        if ($validator->fails()) {
            
            $data['valid']      = false;
            $data['message']    = 'Validation fails!';
            $data['errors']     = $validator->errors();

        }else{

            $has_subscription = $this->subscriptionRepository->getBy('customer_id', $request->get('customer_id'));

            if($has_subscription){

                $data['valid']  = false;
                $data['errors'] = 'This customer already has a subscription...';

            }else{

                $subscription = $this->subscriptionRepository->store($request);

                if($subscription){

                    $data['valid'] = true;
                    $data['message'] = 'Subscription has been created!';
                    $data['data']['subscription'] = $subscription;
                
                }else{

                    $data['valid']  = false;
                    $data['errors'] = 'Subscription cannot be saved...';

                }

            }

        }

        return response()->json($data);

    }

    public function update($id, Request $request){

        $validator = Validator::make($request->all(), [
            'base_price'        => 'numeric|between:20,45',
            'total_price'       => 'numeric|between:17,45',
            'next_order_date'   => 'required|date|date_format:Y-m-d|after_or_equal:tomorrow',
        ]);

        if ($validator->fails()) {
            
            $data['valid']      = false;
            $data['message']    = 'Validation fails!';
            $data['errors']     = $validator->errors();

        }else{

            $subscription = $this->subscriptionRepository->update($id, $request);

            if($subscription){

                $data['valid'] = true;
                $data['message'] = 'Subscription has been updated!';
                $data['data']['subscription'] = $this->subscriptionRepository->get($id);
            
            }else{

                $data['valid']  = false;
                $data['errors'] = 'Subscription cannot be updated...';

            }

        }

        return response()->json($data);

    }

    public function destroy($id){

        $subscription = $this->subscriptionRepository->get($id);
        
        if($subscription){
            
            Subscription::where('id', $id)->delete();
            $data['valid'] = true;
            $data['message'] = 'Subscription has been deleted!';
            $data['data']['subscription'] = $subscription;
            return response()->json($data, 410);
            
        }else{
            
            $data['valid']  = false;
            $data['errors'] = 'Subscription not found...';
            return response()->json($data, 200);

        }

    }

    public function pets($id){

        $subscription = $this->subscriptionRepository->get($id);

        if($subscription){

            $data['valid'] = true;
            $data['data']['subscription'] = $subscription;
            $data['data']['subscription']['pets'] = $subscription->pets;
            
        }else{

            $data['valid'] = false;
            $data['errors'] = 'Subscription pets not found...';

        }

        return response()->json($data);

    }

    public function dispatch($id){

        $subscription = $this->subscriptionRepository->get($id);
        
        if($subscription){

            $subscription->update([
                'last_order_date' => date('Y-m-d'),
                'next_order_date' => date('Y-m-d', strtotime('+ 4 weeks'))
            ]);

            $data['valid'] = true;
            $data['message'] = 'Subscription has been dispatched!';
            $data['data']['subscription'] = $subscription;
            
        }else{

            $data['valid'] = false;
            $data['errors'] = 'Subscription cannot be dispatched...';

        }

        return response()->json($data);

    }

}