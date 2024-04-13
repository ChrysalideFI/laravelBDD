<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Parties
 * 
 * @property int $COURS_num_cours
 * @property int $CHAPITRES_num_chapitre
 * @property int $num_partie
 * @property string $titre_partie
 * @property string $contenu_partie
 * 
 * @property Chapitres $chapitres
 * @property Collection|Examens[] $examens
 * @property Collection|Progressions[] $progressions
 *
 * @package App\Models
 */
class Parties extends Model
{
	use HasFactory;
	protected $table = 'parties';
	public $timestamps = false;

	protected $casts = [
		'COURS_num_cours' => 'int',
		'CHAPITRES_num_chapitre' => 'int'
	];

	protected $fillable = [
		'titre_partie',
		'contenu_partie'
	];

	public function chapitres()
	{
		return $this->belongsTo(Chapitres::class, 'CHAPITRES_num_chapitre')
					->where('chapitres.num_chapitre', '=', 'parties.CHAPITRES_num_chapitre')
					->where('chapitres.COURS_num_cours', '=', 'parties.COURS_num_cours');
	}

	public function examens()
	{
		return $this->hasMany(Examens::class, 'PARTIES_num_partie');
	}

	public function progressions()
	{
		return $this->hasMany(Progressions::class, 'PARTIES_num_partie');
	}
}
