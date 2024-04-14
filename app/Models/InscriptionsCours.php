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
 * Class InscriptionsCours
 * 
 * @property int $num_inscription
 * @property int $UTILISATEURS_num_utilisateur
 * @property int $COURS_num_cours
 * @property float $montant_paye
 * @property bool $paye
 * @property Carbon $date_paiement
 * @property bool $inscription_valide
 * @property Carbon $date_insc_cours
 * 
 * @property Cours $cours
 * @property Utilisateurs $utilisateurs
 * @property Collection|InscriptionsSessions[] $inscriptions_sessions
 *
 * @package App\Models
 */
class InscriptionsCours extends Model
{
	use HasFactory;
	protected $table = 'inscriptions_cours';
	protected $primaryKey = 'num_inscription';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'num_inscription' => 'int',
		'UTILISATEURS_num_utilisateur' => 'int',
		'COURS_num_cours' => 'int',
		'montant_paye' => 'float',
		'paye' => 'bool',
		'date_paiement' => 'datetime',
		'inscription_valide' => 'bool',
		'date_insc_cours' => 'datetime'
	];

	protected $fillable = [
		'UTILISATEURS_num_utilisateur',
		'COURS_num_cours',
		'montant_paye',
		'paye',
		'date_paiement',
		'inscription_valide',
		'date_insc_cours'
	];

	public function cours()
	{
		return $this->belongsTo(Cours::class, 'COURS_num_cours');
	}

	public function utilisateurs()
	{
		return $this->belongsTo(Utilisateurs::class, 'UTILISATEURS_num_utilisateur');
	}

	public function inscriptions_sessions()
	{
		return $this->hasMany(InscriptionsSessions::class, 'INSCRIPTIONS_COURS_num_inscription');
	}
}
