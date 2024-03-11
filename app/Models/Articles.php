<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Articles
 * 
 * @property int $id
 * @property string $title
 * @property string $content
 * @property Carbon $date_created
 * @property int $USERS_id
 * 
 * @property Users $users
 * @property Collection|Comments[] $comments
 *
 * @package App\Models
 */
class Articles extends Model
{
	use HasFactory;
	protected $table = 'ARTICLES';
	public $timestamps = false;

	protected $casts = [
		'date_created' => 'datetime',
		'USERS_id' => 'int'
	];

	protected $fillable = [
		'title',
		'content',
		'date_created',
		'USERS_id'
	];

	public function users()
	{
		return $this->belongsTo(Users::class);
	}

	public function comments()
	{
		return $this->hasMany(Comments::class);
	}
}
