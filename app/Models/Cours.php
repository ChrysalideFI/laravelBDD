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
 * Class Cours
 * 
 * @property int $num_cours
 * @property string $intitule_cours
 * @property string $description
 * @property string $pre_requis
 * @property float $prix_cours
 * @property Carbon|null $date_debut
 * @property Carbon|null $date_fin
 * @property bool|null $visible
 * @property bool|null $accessible
 * 
 * @property Collection|AssignationsCours[] $assignations_cours
 * @property Collection|AvisCours[] $avis_cours
 * @property Collection|Chapitres[] $chapitres
 * @property Collection|InscriptionsCours[] $inscriptions_cours
 * @property Collection|Sessions[] $sessions
 * @property Collection|Utilisateurs[] $utilisateurs
 *
 * @package App\Models
 */
class Cours extends Model
{
	use HasFactory;
	protected $table = 'cours';
	protected $primaryKey = 'num_cours';
	public $timestamps = false;

	protected $casts = [
		'prix_cours' => 'float',
		'date_debut' => 'datetime',
		'date_fin' => 'datetime',
		'visible' => 'bool',
		'accessible' => 'bool'
	];

	protected $fillable = [
		'intitule_cours',
		'description',
		'pre_requis',
		'prix_cours',
		'date_debut',
		'date_fin',
		'visible',
		'accessible'
	];

	public function assignations_cours()
	{
		return $this->hasMany(AssignationsCours::class, 'COURS_num_cours');
	}

	public function avis_cours()
	{
		return $this->hasMany(AvisCours::class, 'COURS_num_cours');
	}

	public function chapitres()
	{
		return $this->hasMany(Chapitres::class, 'COURS_num_cours');
	}

	public function inscriptions_cours()
	{
		return $this->hasMany(InscriptionsCours::class, 'COURS_num_cours');
	}

	public function sessions()
	{
		return $this->hasMany(Sessions::class, 'COURS_num_cours');
	}

	public function utilisateurs()
	{
		return $this->belongsToMany(Utilisateurs::class, 'utilisateurs_cours', 'COURS_num_cours', 'UTILISATEURS_num_utilisateur');
	}
}
