<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 23 Jan 2019 02:53:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Parcel
 * 
 * @property int $id
 * @property int $placed_by
 * @property string $weight
 * @property \Carbon\Carbon $sent_on
 * @property \Carbon\Carbon $deleivered_on
 * @property int $status
 * @property string $from_address
 * @property string $to_address
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\AdminUser $admin_user
 *
 * @package App\Models
 */
class Parcel extends Eloquent
{
	protected $casts = [
		'placed_by' => 'int',
		'status' => 'int'
	];

	protected $dates = [
		'sent_on',
		'deleivered_on'
	];

	protected $fillable = [
		'placed_by',
		'weight',
		'sent_on',
		'deleivered_on',
		'status',
		'from_address',
		'to_address'
	];

	public function admin_user()
	{
		return $this->belongsTo(\App\Models\AdminUser::class, 'placed_by');
	}
}
