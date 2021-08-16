<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Subscription;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PetController extends Controller
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

        $pets = Pet::all();
        
        $data['valid'] = true;
        $data['data']['pets'] = $pets;
        
        return response()->json($data);

    }

    public function show($id){

        $pet = Pet::find($id);

        if($pet){

            $data['valid'] = true;
            $data['data']['pet'] = $pet;
            
        }else{

            $data['valid'] = false;
            $data['errors'] = 'Pet not found...';

        }

        return response()->json($data);

    }

    public function subscription($id){

        $pet = Pet::find($id);

        if($pet){

            $data['valid'] = true;
            $data['data']['pet'] = $pet;
            $data['data']['pet']['subscription'] = $pet->subscription;
            
        }else{

            $data['valid'] = false;
            $data['errors'] = 'Subscription from this pet not found...';

        }

        return response()->json($data);

    }

    public function store(Request $request){

        $pet = Pet::create($request->all());

        if($pet){

            $data['valid'] = true;
            $data['message'] = 'Pet has been created!';
            $data['data']['pet'] = $pet;
        
        }else{

            $data['valid'] = false;
            $data['errors'] = 'Pet cannot be saved...';

        }

        return response()->json($data, 200);

    }

    public function update($id, Request $request){

        $pet = Pet::where('id', $id)->update($request->except('subscription_id'));

        if($pet){

            $data['valid'] = true;
            $data['message'] = 'Pet has been updated!';
            $data['data']['pet'] = Pet::find($id);
        
        }else{

            $data['valid'] = false;
            $data['errors'] = 'Pet cannot be updated...';

        }

        return response()->json($data, 200);

    }

    public function destroy(Request $request, $id){

        $pet = Pet::find($id);
        
        if($pet){
            
            Pet::where('id', $id)->delete();
            $data['valid'] = true;
            $data['message'] = 'Pet has been deleted!';
            $data['data']['pet'] = $pet;
        
        }else{

            $data['valid'] = false;
            $data['errors'] = 'Pet not found...';

        }

        return response()->json($data, 410);

    }
}
