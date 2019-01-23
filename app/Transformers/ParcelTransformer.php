<?php
/**
 * Created by PhpStorm.
 * User: gem
 * Date: 7/13/17
 * Time: 5:35 PM
 */

namespace App\Transformers;


use App\Models\Parcel;
use Carbon\Carbon;
use  \League\Fractal\TransformerAbstract;

class ParcelTransformer extends TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Parcel $parcel)
    {

        $data = [
            'identifier' => $parcel->admin_user->id,
            'name'=>$parcel->admin_user->name,
            'email' => $parcel->admin_user->email
        ];

        $status = null;

        if($parcel->status == 0){
            $status = 'Pending';
        }
        elseif ($parcel->status == 1){
            $status = 'Enroute';
        }elseif ($parcel->status == 2){
            $status='Delivered';
        }else{
            $status='Cancelled';
        }

        return [

            'identifier' => $parcel->id,
            'user' =>$data,
            'weight' =>(int) $parcel->weight,
            'sent_on' =>Carbon::parse($parcel->sent_on)->toDateString(),
            'delivered_on' =>Carbon::parse($parcel->delivered_on)->toDateString(),
            'status' =>$status,
            'from_address' =>$parcel->from_address,
            'to_address' =>$parcel->to_address

        ];
    }

    public function collect($collection)
    {
        $transformer = new AdminUserTransformer();
        return collect($collection)->map(function ($model) use ($transformer) {
            return $transformer->transform($model);
        });
    }

}