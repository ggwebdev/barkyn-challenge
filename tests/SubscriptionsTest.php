<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class SubscriptionsTest extends TestCase
{
    
    /**
     * /subscriptions [GET]
     */
    public function testShouldReturnAllSubscriptions(){

        $this->get("subscriptions", []);
        $this->seeStatusCode(200);
        
    }

    /**
     * /subscriptions/id [GET]
     */
    public function testShouldReturnSubscription(){
        $this->get("subscriptions/2", []);
        $this->seeStatusCode(200);
    }

    /**
     * /subscriptions [POST]
     */
    public function testShouldCreateSubscription(){

        $parameters = [
            'customer_id' => 1,
            'base_price' => 20,
            'total_price' => 17,
            'weight' => 3.00,
            'protein' => 'chicken'
        ];

        $this->post("subscriptions", $parameters, []);
        $this->seeStatusCode(200);
        
    }
    
    /**
     * /subscriptions/id [PUT]
     */
    public function testShouldUpdateSubscription(){

        $parameters = [
            'last_order_date' => date('Y-m-d'),
            'next_order_date' => date('Y-m-d', strtotime('+ 4 weeks'))
        ];

        $this->put("subscriptions/4", $parameters, []);
        $this->seeStatusCode(200);
    }

    /**
     * /subscriptions/id [DELETE]
     */
    public function testShouldDeleteSubscription(){
        
        $this->delete("subscriptions/5", [], []);
        $this->seeStatusCode(410);
        
    }

}
