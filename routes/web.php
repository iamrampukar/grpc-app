<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use App\Proto\Person;
use App\Proto\People;
use App\Proto\BaseModel;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/proto', function () use ($router) {
    $p = new Person();
    $p->setName('Ram Pukar');
    return response($p->serializeToJsonString())
    ->header('content-type','application/json');
});


$router->get('/proto-people', function () use ($router) {
    $people = new People();
    $people->setPeople([
        (function() {
            $p = new Person();
            $p->setName('Ram Pukar');
            return $p;
        })(),
        (function() {
            $p = new Person();
            $p->setName('Adwika');
            return $p;
        })()
    ]);

    
    return response($people->serializeToJsonString())
    ->header('content-type','application/json');
});

$router->get('/proto-people-v1', function () use ($router) {
    $people = new People();
    $people->setPeople([
        (function() {
            $p = new Person();
            $p->setBaseModel((function(){
                $bm = new BaseModel();
                $bm->setId(1);
                return $bm;
            })());
            $p->setName('Ram Pukar v1');
            $p->setAddress('Saptri');
            return $p;
        })(),
        (function() {
            $p = new Person();
            $p->setBaseModel((function(){
                $bm = new BaseModel();
                $bm->setId(2);
                return $bm;
            })());
            $p->setName('Ram Pukar v2');
            $p->setAddress('Malhaniya');
            return $p;
        })(),
    ]);

    
    return response($people->serializeToJsonString())
    ->header('content-type','application/json');
});


$router->get('/proto-parse', function () use ($router) {
    $p = new Person;
    $p->mergeFromJsonString('{
        "name":"Ram Pukar"
    }');

    return response($p->serializeToJsonString())
    ->header('content-type','application/json');
});