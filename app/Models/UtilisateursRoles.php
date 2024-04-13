<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UtilisateursRoles
 * 
 * @property int $UTILISATEURS_num_utilisateur
 * @property int $ROLES_num_role
 * 
 * @property Roles $roles
 * @property Utilisateurs $utilisateurs
 *
 * @package App\Models
 */
class UtilisateursRoles extends Model
{
	use HasFactory;
	protected $table = 'utilisateurs_roles';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'UTILISATEURS_num_utilisateur' => 'int',
		'ROLES_num_role' => 'int'
	];

	public function roles()
	{
		return $this->belongsTo(Roles::class, 'ROLES_num_role');
	}

	public function utilisateurs()
	{
		return $this->belongsTo(Utilisateurs::class, 'UTILISATEURS_num_utilisateur');
	}
}
