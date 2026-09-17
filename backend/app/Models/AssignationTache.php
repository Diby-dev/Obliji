<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignationTache extends Model
{
    use HasFactory;

    /**
     * Statuts normalisés d'une assignation.
     */
    public const STATUT_A_FAIRE = 'a_faire';
    public const STATUT_EN_COURS = 'en_cours';
    public const STATUT_TERMINE = 'termine';
    public const STATUT_VALIDE = 'valide';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'assignations_taches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tache_id',
        'menager_id',
        'admin_id',
        'statut',
        'date_echeance',
        'commentaire_realisation',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_echeance' => 'datetime',
    ];

    /**
     * Ménager assigné à la tâche.
     */
    public function menager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'menager_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Tâche liée à l'assignation.
     */
    public function tache(): BelongsTo
    {
        return $this->belongsTo(Tache::class, 'tache_id');
    }

    /**
     * Vérifie si la tâche est terminée.
     */
    public function isTermine(): bool
    {
        return $this->statut === self::STATUT_TERMINE;
    }

    /**
     * Vérifie si la tâche est en cours.
     */
    public function isEnCours(): bool
    {
        return $this->statut === self::STATUT_EN_COURS;
    }

    /**
     * Vérifie si la tâche est encore à faire.
     */
    public function isAFaire(): bool
    {
        return $this->statut === self::STATUT_A_FAIRE;
    }
}
