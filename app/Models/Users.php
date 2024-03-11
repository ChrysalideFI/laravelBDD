<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Users
 * 
 * @property int $id
 * @property string $email
 * 
 * @property Collection|Articles[] $articles
 * @property Collection|Comments[] $comments
 * @property Collection|UsersUsers[] $users_users
 *
 * @package App\Models
 */
class Users extends Model
{
	use HasFactory;
	protected $table = 'USERS';
	public $timestamps = false;

	protected $fillable = [
		'email'
	];

	public function articles()
	{
		return $this->hasMany(Articles::class);
	}

	public function comments()
	{
		return $this->hasMany(Comments::class);
	}

	public function users_users()
	{
		return $this->hasMany(UsersUsers::class, 'USERS_id2');
	}
}
