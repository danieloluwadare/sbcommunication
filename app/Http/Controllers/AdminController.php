<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateParcel;
use App\Http\Requests\CreateUser;
use App\Models\AdminUser;
use App\Transformers\AdminUserTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AdminController extends Controller
{

    /**
     * @OA\Post(
     *      path="/user/register",
     *      operationId="create",
     *      tags={"Projects"},
     *      summary="Create User",
     *      description="Create user with name  ",
     *      @OA\Parameter(
     *          name="name",
     *          description="name of user",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          description="email of user",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="password of user",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *     security={

     *         {

     *             "oauth2_security_example": {"write:projects", "read:projects"}

     *         }

     *     },
     * )
     */
    public function register(CreateUser $request){

        $input = $request->only('name', 'email','password');
        $input['password'] = Hash::make($input['password']);

        $user = AdminUser::create($input);
        $user = (new AdminUserTransformer())->transform($user);
        return $this->showOne($user);
    }

    /**
     * @OA\Post(
     *      path="/user/login",
     *      operationId="Login",
     *      tags={"Projects"},
     *      summary="Login User",
     *      description="login  ",
     *      @OA\Parameter(
     *          name="email",
     *          description="email of user",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="password of user",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *     security={

     *         {

     *             "oauth2_security_example": {"write:projects", "read:projects"}

     *         }

     *     },
     * )
     */
    public function login(Request $request){
        // grab credentials from the request
        $credentials = $request->only('email', 'password');
        $customClaims = ['email' => $request->email];

        try {
            if (! $token = JWTAuth::attempt($credentials,$customClaims)) {
//                return response()->json(['error' => 'invalid_credentials'], 401);
                return $this->errorResponse('invalid_credentials',401);

            }
        } catch (JWTException $e) {
            return $this->errorResponse('could_not_create_token',500);
        }


        return $this->showOne(compact('token'));
    }

    /**
     * @OA\Post(
     *      path="/user/create/parcel",
     *      operationId="CreateParcel",
     *      tags={"Projects"},
     *      summary="Create Parcel details",
     *      description="--  ",
     *      @OA\Parameter(
     *          name="weight",
     *          description="Weight of the Parcel",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="from_address",
     *          description="Address of the sender",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="to_address",
     *          description="Address of Receiver",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *     security={

     *         {

     *             "oauth2_security_example": {"write:projects", "read:projects"}

     *         }

     *     },
     * )
     */

    public function createParcel(CreateParcel $request){
        $user = $this->getAuthenticatedUser();
        $input = $request->only('weight', 'from_address','to_address');
        $input['sent_on'] = Carbon::now();
        $input['status'] = 0;

        $user->parcels()->create($input);
        return $this->showOne($user->parcels);

    }

}