<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TentativesExamens
 * 
 * @property int $UTILISATEURS_num_utilisateur
 * @property int $EXAMENS_num_examen
 * @property int $num_tentative
 * @property Carbon $date_tentative
 * @property int $score_obtenu
 * @property string $valide
 * 
 * @property Utilisateurs $utilisateurs
 * @property Examens $examens
 *
 * @package App\Models
 */
class TentativesExamens extends Model
{
	use HasFactory;
	protected $table = 'tentatives_examens';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'UTILISATEURS_num_utilisateur' => 'int',
		'EXAMENS_num_examen' => 'int',
		'num_tentative' => 'int',
		'date_tentative' => 'datetime',
		'score_obtenu' => 'int'
	];

	protected $fillable = [
		'date_tentative',
		'score_obtenu',
		'valide'
	];

	public function utilisateurs()
	{
		return $this->belongsTo(Utilisateurs::class, 'UTILISATEURS_num_utilisateur');
	}

	public function examens()
	{
		return $this->belongsTo(Examens::class, 'EXAMENS_num_examen');
	}
}
