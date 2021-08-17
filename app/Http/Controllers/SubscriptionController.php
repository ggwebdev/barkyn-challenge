<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Subscription;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(){

        $subscriptions = Subscription::all();
        
        $data['valid'] = true;
        $data['data']['subscriptions'] = $subscriptions;
        
        return response()->json($data);

    }

    public function show($id){

        $subscription = Subscription::find($id);

        if($subscription){

            $data['valid'] = true;
            $data['data']['subscription'] = $subscription;
            
        }else{

            $data['valid'] = false;
            $data['errors'] = 'Subscription not found...';

        }

        return response()->json($data);

    }

    public function pets($id){

        $subscription = Subscription::find($id);

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

            $has_subscription = Subscription::where('customer_id', $request->get('customer_id'))->first();

            if($has_subscription){

                $data['valid']  = false;
                $data['errors'] = 'This customer already has a subscription...';

            }else{

                $subscription = Subscription::create($request->all());

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

            $subscription = Subscription::where('id', $id)->update($request->except('customer_id'));

            if($subscription){

                $data['valid'] = true;
                $data['message'] = 'Subscription has been updated!';
                $data['data']['subscription'] = Subscription::find($id);
            
            }else{

                $data['valid']  = false;
                $data['errors'] = 'Subscription cannot be updated...';

            }

        }

        return response()->json($data);

    }

    public function destroy(Request $request, $id){

        $subscription = Subscription::find($id);
        
        if($subscription){
            
            Subscription::where('id', $id)->delete();
            $data['valid'] = true;
            $data['message'] = 'Subscription has been deleted!';
            $data['data']['subscription'] = $subscription;
        
        }else{

            $data['valid']  = false;
            $data['errors'] = 'Subscription not found...';

        }

        return response()->json($data, 410);

    }

    public function Dispatch($id){

        $subscription = Subscription::find($id);
        
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
