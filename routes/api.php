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


//dd($api);
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



//    $api->post('user/register', function (){
//        return "ok"
//    });

//    $api->get('', 'APIOthersController@categories');
//    $api->prefix('user')->group(function ($api) {
//        $api->get('regisration','AdminController@test');
//
//    });

//    $api->prefix('user')->group(function ($api) {
//        $api->get('regisration','AdminController@test');
//
//    });

//
//    $api->get('doc', 'HomeController@doc');
//
//    $api->patch('/auth/refresh', [
//        'uses' => 'APIAuthenticateController@patchRefresh',
//    ]);
//
//    $api->get('latestAppVersion', 'APIOthersController@latestAppVersion');
//
//    $api->get('categories', 'APIOthersController@categories');
//    $api->post('food/category', 'APIOthersController@food_category');
//    $api->post('auth/login', 'APIAuthenticateController@postLogin');
//    $api->post('auth/sign-up', 'APIAuthenticateController@sign_up');
//    $api->post('auth/logout', 'APIAuthenticateController@logout');
//    $api->post('search/food', 'APIOthersController@search_food');
//    $api->post('combo', 'APIOthersController@combo');
//    $api->post('order', 'APIOthersController@order_food');
//    $api->post('email/user', 'APIOthersController@getUser');
//    $api->post('update/dispatcher', 'APIOthersController@updateDispatcher');
//    $api->get('slideshow', 'APIOthersController@slideshow');
//
//
//    $api->post('city', 'APIOthersController@city');
//    $api->post('paystackCurlApi', 'APIOthersController@paystackCurlApi');
//    $api->post('pushNotification', 'APIOthersController@pushNotification');
//    $api->post('updateGCMIDS', 'APIOthersController@updateGCMIDS');
//    $api->post('rateService', 'APIOthersController@rateService');
//
//    $api->post('auth/send-password-reset-link', 'APIAuthenticateController@send_password_reset_link');
//
//
//    $api->group(['middleware' => 'api.aut'], function ($api) {
//        $api->post('/auth/change-password', 'APIAuthenticateController@change_password');
//        $api->post('/auth/update/profile', 'APIAuthenticateController@update_profile');
//        $api->post('/auth/add/address', 'APIAuthenticateController@add_address');
//        $api->delete('/auth/remove/address', 'APIAuthenticateController@remove_address');
//        $api->post('/auth/remove/address', 'APIAuthenticateController@remove_address');
//
//        $api->delete('/auth/invalidate', [
//            'uses' => 'APIAuthenticateController@deleteInvalidate',
//        ]);
//        $api->get('/auth/user', [
//            'uses' => 'APIAuthenticateController@getUser',
//        ]);
//        $api->get('/my_orders', 'APIOthersController@my_orders');
//
//    });
//
//    $api->post('/dispatcher/login', 'APIDispatcherController@postLogin')->name('jwt.login');
//
//    $api->group(['middleware' => 'dispatcher'], function ($api) {
//        $api->get('/dispatcher/my_orders', 'APIDispatcherController@my_orders')->name('my_order');
//        $api->post('/dispatcher/status_change', 'APIDispatcherController@status_change')->name('status_change');
//    });
//
//    $api->post('/jwt/refresh', '\Paulvl\JWTGuard\Http\Controllers\Auth\LoginController@refresh')->name('jwt.refresh');
});
