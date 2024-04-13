<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AssignationsSessions
 * 
 * @property int $COURS_num_cours
 * @property int $UTILISATEURS_num_utilisateur
 * @property int $SESSIONS_num_session
 * 
 * @property Sessions $sessions
 * @property Utilisateurs $utilisateurs
 *
 * @package App\Models
 */
class AssignationsSessions extends Model
{
	use HasFactory;
	protected $table = 'assignations_sessions';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'COURS_num_cours' => 'int',
		'UTILISATEURS_num_utilisateur' => 'int',
		'SESSIONS_num_session' => 'int'
	];

	public function sessions()
	{
		return $this->belongsTo(Sessions::class, 'SESSIONS_num_session')
					->where('sessions.num_session', '=', 'assignations_sessions.SESSIONS_num_session')
					->where('sessions.COURS_num_cours', '=', 'assignations_sessions.COURS_num_cours');
	}

	public function utilisateurs()
	{
		return $this->belongsTo(Utilisateurs::class, 'UTILISATEURS_num_utilisateur');
	}
}
