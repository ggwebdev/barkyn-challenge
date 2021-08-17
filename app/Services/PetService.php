<?php

namespace App\Services;

use App\Repositories\Contracts\PetRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Pet;
use Illuminate\Support\Facades\Validator;

class PetService {

    private $petRepository;
    
    public function __construct(PetRepositoryInterface $petRepository)
    {
        $this->petRepository = $petRepository;
    }
    
    public function getAll(){

        $pets = $this->petRepository->getAll();
        
        $data['valid'] = true;
        $data['data']['pets'] = $pets;
        
        return response()->json($data);

    }

    public function get($id){

        $pet = $this->petRepository->get($id);

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

        $pet = $this->petRepository->get($id);

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

        $pet = $this->petRepository->store($request);

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

        $pet = $this->petRepository->update($id, $request);

        if($pet){

            $data['valid'] = true;
            $data['message'] = 'Pet has been updated!';
            $data['data']['pet'] = $this->petRepository->get($id);
        
        }else{

            $data['valid'] = false;
            $data['errors'] = 'Pet cannot be updated...';

        }

        return response()->json($data, 200);

    }

    public function destroy($id){

        $pet = $this->petRepository->get($id);
        
        if($pet){
            
            $this->petRepository->destroy($id);
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