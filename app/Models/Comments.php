<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comments
 * 
 * @property int $id
 * @property string $content
 * @property int $ARTICLES_id
 * @property int $USERS_id
 * 
 * @property Articles $articles
 * @property Users $users
 *
 * @package App\Models
 */
class Comments extends Model
{
	use HasFactory;
	protected $table = 'COMMENTS';
	public $timestamps = false;

	protected $casts = [
		'ARTICLES_id' => 'int',
		'USERS_id' => 'int'
	];

	protected $fillable = [
		'content',
		'ARTICLES_id',
		'USERS_id'
	];

	public function articles()
	{
		return $this->belongsTo(Articles::class);
	}

	public function users()
	{
		return $this->belongsTo(Users::class);
	}
}
