<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Utilisateurs
 * 
 * @property int $num_utilisateur
 * @property string $nom
 * @property string $prenom
 * 
 * @property Collection|AssignationsCours[] $assignations_cours
 * @property Collection|AssignationsSessions[] $assignations_sessions
 * @property Collection|AvisCours[] $avis_cours
 * @property Collection|InscriptionsCours[] $inscriptions_cours
 * @property Collection|Progressions[] $progressions
 * @property Collection|TentativesExamens[] $tentatives_examens
 * @property Collection|Cours[] $cours
 * @property Collection|Roles[] $roles
 *
 * @package App\Models
 */
class Utilisateurs extends Model
{
	use HasFactory;
	protected $table = 'utilisateurs';
	protected $primaryKey = 'num_utilisateur';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'num_utilisateur' => 'int'
	];

	protected $fillable = [
		'nom',
		'prenom'
	];

	public function assignations_cours()
	{
		return $this->hasMany(AssignationsCours::class, 'UTILISATEURS_num_utilisateur');
	}

	public function assignations_sessions()
	{
		return $this->hasMany(AssignationsSessions::class, 'UTILISATEURS_num_utilisateur');
	}

	public function avis_cours()
	{
		return $this->hasMany(AvisCours::class, 'UTILISATEURS_num_utilisateur');
	}

	public function inscriptions_cours()
	{
		return $this->hasMany(InscriptionsCours::class, 'UTILISATEURS_num_utilisateur');
	}

	public function progressions()
	{
		return $this->hasMany(Progressions::class, 'UTILISATEURS_num_utilisateur');
	}

	public function tentatives_examens()
	{
		return $this->hasMany(TentativesExamens::class, 'UTILISATEURS_num_utilisateur');
	}

	public function cours()
	{
		return $this->belongsToMany(Cours::class, 'utilisateurs_cours', 'UTILISATEURS_num_utilisateur', 'COURS_num_cours');
	}

	public function roles()
	{
		return $this->belongsToMany(Roles::class, 'utilisateurs_roles', 'UTILISATEURS_num_utilisateur', 'ROLES_num_role');
	}
}
