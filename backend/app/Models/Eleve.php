<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Classe; // Assurez-vous d'importer Classe si EleveController n'est pas dans le même namespace

/**
 * @property int $id
 * @property string $matricule
 * @property string $nom
 * @property string $prenoms
 * @property string $date_naissance
 * @property string|null $lieu_naissance
 * @property string|null $nationalite
 * @property string $sexe
 * @property string|null $lv2
 * @property string|null $ap_mu
 * @property string $tuteur_telephone
 * @property string|null $email
 * @property string|null $photo_url
 * @property bool|null $affecte
 * @property bool $redouble
 * @property int $classe_id
 * @property string $created_at
 * @property string $updated_at
 * * @property-read \App\Models\Classe $classe La relation vers la classe de l'élève.
 */
class Eleve extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     * Inclut tous les champs de la migration.
     */
    protected $fillable = [
        'matricule',
        'nom',
        'prenoms',
        'date_naissance',
        'lieu_naissance',
        'nationalite',
        'sexe',
        
        // Nouveaux champs
        'lv2',          // Langue Vivante 2
        'ap_mu',
        'preced_classe',
        'qrcode',        // Option Art Plastique / Musique

        'tuteur_telephone',
        'email',
        'photo_url',
        
        // Statut et clé étrangère
        'affecte',
        'redouble',     // Nouveau champ
        'classe_id',    // Clé étrangère
    ];

    /**
     * Un élève appartient à une seule classe.
     * Définit la relation BelongsTo (enfant).
     */
    public function classe(): BelongsTo
    {
        // La méthode belongsTo utilise par défaut 'classe_id' comme clé étrangère
        return $this->belongsTo(Classe::class);
    }
}
