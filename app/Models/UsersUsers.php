<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UsersUsers
 * 
 * @property int $USERS_id1
 * @property int $USERS_id2
 * 
 * @property Users $users
 *
 * @package App\Models
 */
class UsersUsers extends Model
{
	use HasFactory;
	protected $table = 'USERS_USERS';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'USERS_id1' => 'int',
		'USERS_id2' => 'int'
	];

	public function users()
	{
		return $this->belongsTo(Users::class, 'USERS_id2');
	}
}
