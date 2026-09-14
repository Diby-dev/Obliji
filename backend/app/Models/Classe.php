<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Ajout de HasFactory (recommandé)
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Ajout de l'importation de la relation HasMany

class Classe extends Model
{
    use HasFactory; // Utilisation du trait pour les factories (si vous en avez besoin)

    /**
     * Les attributs qui sont assignables en masse.
     * Inclut les colonnes 'nom_classe' et 'preced_classe'.
     */
    protected $fillable = [
        'nom_classe',
        'type_classe',
    ];

    /**
     * Une classe peut avoir plusieurs élèves.
     * Définit la relation One-to-Many.
     */
    public function eleves(): HasMany
    {
        // La méthode hasMany utilise par défaut 'classe_id' comme clé étrangère
        return $this->hasMany(Eleve::class);
    }
}