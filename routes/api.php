<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


$api = app(Dingo\Api\Routing\Router::class);


$api->version('v1', ['namespace' => '\App\Http\Controllers'], function ($api) {

    $api->post('/user/register','AdminController@register');
    $api->post('/user/login','AdminController@login');

    $api->group(['middleware' => 'jwt.auth'], function ($api) {

        $api->post('/user/create/parcel','AdminController@createParcel');
        $api->put('/user/updateParcelDestination/{id}','ParcelController@updateDestination');
        $api->put('/user/cancelParcelDelivery/{id}','ParcelController@cancelDelivery');
        $api->put('/user/updateEnrouteDelivery/{id}','ParcelController@enrouteDelivery');
        $api->put('/user/updateCompleteDelivery/{id}','ParcelController@completeDelivery');
        $api->get('/user/getParcelDetails/{id}','ParcelController@parcelDetail');
    });

});
