<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 23 Jan 2019 02:53:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class AdminUser
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $parcels
 *
 * @package App\Models
 */

class AdminUser extends Authenticatable
{
	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'email',
		'password'
	];

	public function parcels()
	{
		return $this->hasMany(\App\Models\Parcel::class, 'placed_by');
	}
}
