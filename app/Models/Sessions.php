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
 * Class Sessions
 * 
 * @property int $num_session
 * @property int $COURS_num_cours
 * @property string $format_session
 * @property Carbon $date_heure_debut
 * @property Carbon $date_heure_fin
 * @property int|null $places_max
 * 
 * @property Cours $cours
 * @property Collection|AssignationsSessions[] $assignations_sessions
 * @property Collection|InscriptionsSessions[] $inscriptions_sessions
 *
 * @package App\Models
 */
class Sessions extends Model
{
	use HasFactory;
	protected $table = 'sessions';
	public $timestamps = false;

	protected $casts = [
		'COURS_num_cours' => 'int',
		'date_heure_debut' => 'datetime',
		'date_heure_fin' => 'datetime',
		'places_max' => 'int'
	];

	protected $fillable = [
		'format_session',
		'date_heure_debut',
		'date_heure_fin',
		'places_max'
	];

	public function cours()
	{
		return $this->belongsTo(Cours::class, 'COURS_num_cours');
	}

	public function assignations_sessions()
	{
		return $this->hasMany(AssignationsSessions::class, 'SESSIONS_num_session');
	}

	public function inscriptions_sessions()
	{
		return $this->hasMany(InscriptionsSessions::class, 'SESSIONS_num_session');
	}
}
