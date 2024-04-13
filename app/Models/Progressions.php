<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Progressions
 * 
 * @property int $UTILISATEURS_num_utilisateur
 * @property int $COURS_num_cours
 * @property int $CHAPITRES_num_chapitre
 * @property int $PARTIES_num_partie
 * @property bool $partie_termine
 * 
 * @property Parties $parties
 * @property Utilisateurs $utilisateurs
 *
 * @package App\Models
 */
class Progressions extends Model
{
	use HasFactory;
	protected $table = 'progressions';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'UTILISATEURS_num_utilisateur' => 'int',
		'COURS_num_cours' => 'int',
		'CHAPITRES_num_chapitre' => 'int',
		'PARTIES_num_partie' => 'int',
		'partie_termine' => 'bool'
	];

	protected $fillable = [
		'partie_termine'
	];

	public function parties()
	{
		return $this->belongsTo(Parties::class, 'PARTIES_num_partie')
					->where('parties.num_partie', '=', 'progressions.PARTIES_num_partie')
					->where('parties.CHAPITRES_num_chapitre', '=', 'progressions.CHAPITRES_num_chapitre')
					->where('parties.COURS_num_cours', '=', 'progressions.COURS_num_cours');
	}

	public function utilisateurs()
	{
		return $this->belongsTo(Utilisateurs::class, 'UTILISATEURS_num_utilisateur');
	}
}
