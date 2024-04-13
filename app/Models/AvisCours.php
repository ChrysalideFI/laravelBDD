<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AvisCours
 * 
 * @property int $UTILISATEURS_num_utilisateur
 * @property int $COURS_num_cours
 * @property int $note_cours
 * @property string|null $commentaire_cours
 * 
 * @property Cours $cours
 * @property Utilisateurs $utilisateurs
 *
 * @package App\Models
 */
class AvisCours extends Model
{
	use HasFactory;
	protected $table = 'avis_cours';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'UTILISATEURS_num_utilisateur' => 'int',
		'COURS_num_cours' => 'int',
		'note_cours' => 'int'
	];

	protected $fillable = [
		'note_cours',
		'commentaire_cours'
	];

	public function cours()
	{
		return $this->belongsTo(Cours::class, 'COURS_num_cours');
	}

	public function utilisateurs()
	{
		return $this->belongsTo(Utilisateurs::class, 'UTILISATEURS_num_utilisateur');
	}
}
