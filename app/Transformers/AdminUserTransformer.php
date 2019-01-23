<?php
/**
 * Created by PhpStorm.
 * User: gem
 * Date: 7/13/17
 * Time: 5:35 PM
 */

namespace App\Transformers;


use App\Address;
use App\Models\AdminUser;
use App\User;
use  \League\Fractal\TransformerAbstract;

class AdminUserTransformer extends TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(AdminUser $user)
    {

        return [
            'identifier' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
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