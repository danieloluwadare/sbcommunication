<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    //

    /**
     * @OA\Put(
     *      path="/user/updateParcelDestination/{id}'",
     *      operationId="Update",
     *      tags={"Projects"},
     *      summary="Update Parcel destination",
     *      description="--  ",
     *      @OA\Parameter(
     *          name="to_address",
     *          description="Address of the receiver",
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
    public function updateDestination(Request $request,$id)
    {
        Parcel::where('id', $id)->update(['to_address'=> $request->to_address]);
        $parcel = Parcel::where('id', $id)->first();
         return $this->showOne($parcel);
    }

    /**
     * @OA\Put(
     *      path="/user/cancelParcelDelivery/{id}'",
     *      operationId="Update",
     *      tags={"Projects"},
     *      summary="Cancel Parcel ",
     *      description="--  ",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of the parcel",
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
    public function cancelDelivery($id)
    {
        Parcel::where('id', $id)->update(['status'=> 4]);
        $parcel = Parcel::where('id', $id)->first();
        return $this->showOne($parcel);
    }


    /**
     * @OA\Put(
     *      path="/user/updateEnrouteDelivery/{id}'",
     *      operationId="Update",
     *      tags={"Projects"},
     *      summary="Update Parcel status",
     *      description="--  ",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of the parcel",
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
    public function enrouteDelivery($id)
    {
        Parcel::where('id', $id)->update(['status'=> 1]);
        $parcel = Parcel::where('id', $id)->first();
        return $this->showOne($parcel);
    }


    /**
     * @OA\Put(
     *      path="/user/updateCompleteDelivery/{id}'",
     *      operationId="Complete",
     *      tags={"Projects"},
     *      summary="Complete Parcel status",
     *      description="--  ",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of the parcel",
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

    public function completeDelivery($id)
    {
        Parcel::where('id', $id)->update(['status'=> 2, 'delivered_on' => Carbon::now()]);
        $parcel = Parcel::where('id', $id)->first();
        return $this->showOne($parcel);
    }

    /**
     * @OA\Get(
     *      path="/user/getParcelDetails/{id}",
     *      operationId="Fetch",
     *      tags={"Projects"},
     *      summary="Fetch Parcel detail",
     *      description="--  ",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of the parcel",
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

    public function parcelDetail($id)
    {
        Parcel::where('id', $id)->update(['status'=> 4]);
        $parcel = Parcel::with('admin_user')->where('id', $id)->first();
        return $this->showOne($parcel);
    }


}
