<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('subscription_id')->unsigned();
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
            
            $table->string('name', 255);
            $table->enum('gender', ['male', 'female']);
            $table->date('birth_date')->nullable();
            $table->enum('lifestage', ['Puppy', 'Adult', 'Senior'])->nullable();
            $table->decimal('weight', 8, 2);
            $table->string('photo', 255)->nullable();
            $table->string('breed', 255)->nullable();
            $table->enum('activity', ['Lazy', 'Normal', 'Active'])->nullable();
            $table->enum('body_type', ['Skinny', 'Normal', 'Fat'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets');
    }
}
