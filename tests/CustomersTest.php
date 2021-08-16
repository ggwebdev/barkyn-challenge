<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CustomerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/customers/1');
        $this->response->assertJson([
            'valid' => true,
        ]);
    }

    /**
     * /customers [GET]
     */
    public function testShouldReturnAllCustomers(){

        $this->get("customers", []);
        $this->seeStatusCode(200);
        
    }

    /**
     * /customers/id [GET]
     */
    public function testShouldReturnCustomer(){
        $this->get("customers/2", []);
        $this->seeStatusCode(200);
    }

    /**
     * /customers [POST]
     */
    public function testShouldCreateCustomer(){

        $parameters = [
            'name' => 'Alyne Ester',
            'gender' => 'female',
            'birth_date' => '1999-07-28',
            'email' => 'alyne.ester@gmail.com'
        ];

        $this->post("customers", $parameters, []);
        $this->seeStatusCode(200);
        
    }
    
    /**
     * /customers/id [PUT]
     */
    public function testShouldUpdateCustomer(){

        $parameters = [
            'name' => 'Fulano de Tal',
            'gender' => 'male',
            'birth_date' => '1985-07-25'
        ];

        $this->put("customers/4", $parameters, []);
        $this->seeStatusCode(200);
    }

    /**
     * /customers/id [DELETE]
     */
    public function testShouldDeleteCustomer(){
        
        $this->delete("customers/5", [], []);
        $this->seeStatusCode(410);
        
    }

}
