<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Roles
 * 
 * @property int $num_role
 * @property string $role
 * 
 * @property Collection|Utilisateurs[] $utilisateurs
 *
 * @package App\Models
 */
class Roles extends Model
{
	use HasFactory;
	protected $table = 'roles';
	protected $primaryKey = 'num_role';
	public $timestamps = false;

	protected $fillable = [
		'role'
	];

	public function utilisateurs()
	{
		return $this->belongsToMany(Utilisateurs::class, 'utilisateurs_roles', 'ROLES_num_role', 'UTILISATEURS_num_utilisateur');
	}
}
