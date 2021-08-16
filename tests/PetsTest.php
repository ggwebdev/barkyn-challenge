<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PetsTest extends TestCase
{
    
    /**
     * /pets [GET]
     */
    public function testShouldReturnAllPets(){

        $this->get("pets", []);
        $this->seeStatusCode(200);
        
    }

    /**
     * /pets/id [GET]
     */
    public function testShouldReturnPet(){
        $this->get("pets/2", []);
        $this->seeStatusCode(200);
    }

    /**
     * /pets [POST]
     */
    public function testShouldCreatePet(){

        $parameters = [
            'subscription_id' => 3,
            'name' => 'Thor',
            'gender' => 'male',
            'birth_date' => '2015-07-21',
            'lifestage' => 'Senior',
            'weight' => 19.00,
            'photo' => '',
            'breed' => 'Fila Brasileiro',
            'activity' => 'Normal',
            'body_type' => 'Normal'
        ];

        $this->post("pets", $parameters, []);
        $this->seeStatusCode(200);
        
    }
    
    /**
     * /pets/id [PUT]
     */
    public function testShouldUpdatePet(){

        $parameters = [
            'name' => 'Thor',
            'gender' => 'male',
            'breed' => 'Fila Brasileiro',
            'birth_date' => '2014-07-21',
            'lifestage' => 'Senior',
            'activity' => 'Normal',
            'body_type' => 'Fat',
            'weight' => 27,
        ];

        $this->put("pets/4", $parameters, []);
        $this->seeStatusCode(200);
    }

    /**
     * /pets/id [DELETE]
     */
    public function testShouldDeletePet(){
        
        $this->delete("pets/5", [], []);
        $this->seeStatusCode(410);
        
    }

}
