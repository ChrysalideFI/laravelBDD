<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Examens
 * 
 * @property int $num_examen
 * @property int $COURS_num_cours
 * @property int $CHAPITRES_num_chapitre
 * @property int $PARTIES_num_partie
 * @property string $titre_exam
 * @property string $contenu_exam
 * @property int $score_minimum
 * 
 * @property Parties $parties
 * @property Collection|TentativesExamens[] $tentatives_examens
 *
 * @package App\Models
 */
class Examens extends Model
{
	use HasFactory;
	protected $table = 'examens';
	protected $primaryKey = 'num_examen';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'num_examen' => 'int',
		'COURS_num_cours' => 'int',
		'CHAPITRES_num_chapitre' => 'int',
		'PARTIES_num_partie' => 'int',
		'score_minimum' => 'int'
	];

	protected $fillable = [
		'COURS_num_cours',
		'CHAPITRES_num_chapitre',
		'PARTIES_num_partie',
		'titre_exam',
		'contenu_exam',
		'score_minimum'
	];

	public function parties()
	{
		return $this->belongsTo(Parties::class, 'PARTIES_num_partie')
					->where('parties.num_partie', '=', 'examens.PARTIES_num_partie')
					->where('parties.CHAPITRES_num_chapitre', '=', 'examens.CHAPITRES_num_chapitre')
					->where('parties.COURS_num_cours', '=', 'examens.COURS_num_cours');
	}

	public function tentatives_examens()
	{
		return $this->hasMany(TentativesExamens::class, 'EXAMENS_num_examen');
	}
}
