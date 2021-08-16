# Barkyn API

## Challenge resume:
Create an rest API using PHP or Golang, that allows the management of customers, subscriptions and pets, in accordance with the specifications passed by Barkyn in [this link](https://gist.github.com/barkyndev/3048763d21f80a3b6355f10ee7510b6a).



## Technologies
In this challenge I decided to use Lumen micro-framework by Laravel, widely used for creating APIs and microservices being one of the fastest micro-frameworks available. Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs). The all what I used in this project was:

Lumen micro-framework PHP
MySQL
Docker
PhpUnit
Postman

## Running the project

1 ```git clone git@github.com:ggwebdev/barkyn-challenge.git```

2 ```cd barkyn-challenge```

3 ```composer install``` to install Lumen dependencies

4 ```docker-compose up -d``` to up running the containers.

5 ```docker exec app-app php artisan migrate:fresh --seed --force``` to run migrations and seeds

6 ```docker exec app-app php vendor/phpunit/phpunit/phpunit``` to run the units tests

7 Import the ```Barkyn.postman_collection.json``` file, located in the project's root folder, into Postman to access the project's collections and see the API working!


Thats all. I hope I have achieved the challenge objective. =)

Gabriel Neves
