<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InscriptionsSessions
 * 
 * @property int $SESSIONS_num_session
 * @property int $INSCRIPTIONS_COURS_num_inscription
 * @property int $COURS_num_cours
 * @property Carbon $date_insc_session
 * 
 * @property InscriptionsCours $inscriptions_cours
 * @property Sessions $sessions
 *
 * @package App\Models
 */
class InscriptionsSessions extends Model
{
	use HasFactory;
	protected $table = 'inscriptions_sessions';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'SESSIONS_num_session' => 'int',
		'INSCRIPTIONS_COURS_num_inscription' => 'int',
		'COURS_num_cours' => 'int',
		'date_insc_session' => 'datetime'
	];

	protected $fillable = [
		'date_insc_session'
	];

	public function inscriptions_cours()
	{
		return $this->belongsTo(InscriptionsCours::class, 'INSCRIPTIONS_COURS_num_inscription');
	}

	public function sessions()
	{
		return $this->belongsTo(Sessions::class, 'SESSIONS_num_session')
					->where('sessions.num_session', '=', 'inscriptions_sessions.SESSIONS_num_session')
					->where('sessions.COURS_num_cours', '=', 'inscriptions_sessions.COURS_num_cours');
	}
}
