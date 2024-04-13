<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Chapitres
 * 
 * @property int $COURS_num_cours
 * @property int $num_chapitre
 * @property string $titre_chapitre
 * 
 * @property Cours $cours
 * @property Collection|Parties[] $parties
 *
 * @package App\Models
 */
class Chapitres extends Model
{
	use HasFactory;
	protected $table = 'chapitres';
	public $timestamps = false;

	protected $casts = [
		'COURS_num_cours' => 'int'
	];

	protected $fillable = [
		'titre_chapitre'
	];

	public function cours()
	{
		return $this->belongsTo(Cours::class, 'COURS_num_cours');
	}

	public function parties()
	{
		return $this->hasMany(Parties::class, 'CHAPITRES_num_chapitre');
	}
}
