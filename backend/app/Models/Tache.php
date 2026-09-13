<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tache extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'taches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titre',
        'description',
        'piece',           // ex: 'salon', 'cuisine', 'salle_de_bain', 'chambre'
        'frequence',       // ex: 'quotidien', 'hebdomadaire', 'mensuel'
        'duree_estimee',   // durée estimée en minutes
        'difficulte',      // ex: 'facile', 'moyen', 'difficile'
    ];

    /**
     * Historique des assignations de cette tâche.
     */
    public function assignations(): HasMany
    {
        return $this->hasMany(AssignationTache::class, 'tache_id');
    }

    /**
     * Utilisateurs (ménagers) auxquels cette tâche a été assignée.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'assignations_taches', 'tache_id', 'user_id')
                    ->withPivot('statut', 'date_echeance', 'commentaires')
                    ->withTimestamps();
    }
}
