<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Eleve;
use Illuminate\Support\Carbon;

class Eleves4emeHonestySeeder extends Seeder
{
    /**
     * Exécute les insertions pour les élèves de la 4ème Honesty (ID 5).
     */
    public function run(): void
    {
        // 1. Définir l'ID de la classe (ID 5 pour 4ème Honesty)
        $classeIdQuatriemeHonesty = 5; 

        // Données communes / par défaut
        $tuteurTelephone = '01 02 12 39 17'; // Téléphone par défaut
        $now = Carbon::now();
        $nationaliteIvoirienne = 'Ivoirienne';

        // 2. Définir les données des 16 élèves de la 4ème Honesty
        $elevesDataHonesty = [
            // Mat, Nom & prénoms, Date Naiss, Lieu Naiss, Sexe, Classe Préc, Nat (LV2: ESP=Espagnol)
            [
                'matricule' => '23765182G',
                'nom' => 'AHOUSSI',
                'prenoms' => 'AMAN AARON WILLIAM HABIB',
                'date_naissance' => '2012-09-09',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '5ème1',
                'nationalite' => $nationaliteIvoirienne, // Non spécifié, défaut Ivoirienne
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23681050Q',
                'nom' => 'DAKOURI',
                'prenoms' => 'NETHANIA JERIEL BLESSING',
                'date_naissance' => '2012-12-14',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '5ème2',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23717324E',
                'nom' => 'DJÉHOURI',
                'prenoms' => 'NIAGNE PIERRE-EVAN KONAN',
                'date_naissance' => '2012-10-26',
                'lieu_naissance' => 'FRANCE',
                'sexe' => 'Masculin',
                'preced_classe' => '5ème2',
                'nationalite' => 'Française', // Lu comme '0'/'FR' dans la colonne Nat
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23822443G',
                'nom' => 'GANSÉ',
                'prenoms' => 'FIFAME FRIDA JOANELLE',
                'date_naissance' => '2012-11-13',
                'lieu_naissance' => 'BENIN',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème1',
                'nationalite' => $nationaliteIvoirienne, // Non spécifié, défaut Ivoirienne
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23559183Y',
                'nom' => 'GONDO',
                'prenoms' => 'MARC YOHANN ISRAEL',
                'date_naissance' => '2012-04-24',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '5ème2',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23738936D',
                'nom' => 'GONDO',
                'prenoms' => 'VASSY ANGE-LAËLLE CAELI',
                'date_naissance' => '2012-09-16',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème2',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23866274E',
                'nom' => 'KAMKAYOUA',
                'prenoms' => 'ASHTA MARIA JEFFRYSKA',
                'date_naissance' => '2014-09-02',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème2',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23758756E',
                'nom' => 'KOFFI',
                'prenoms' => 'MAELIG EMMANUEL PIERIG',
                'date_naissance' => '2012-01-19',
                'lieu_naissance' => 'CANADA',
                'sexe' => 'Masculin',
                'preced_classe' => '5ème1',
                'nationalite' => 'Canadienne', // Lu comme '0'/'CA'
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23557609C',
                'nom' => 'KOUAHO',
                'prenoms' => 'ALEXANDRA KAYLISS',
                'date_naissance' => '2012-06-02',
                'lieu_naissance' => 'USA',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème1',
                'nationalite' => 'Américaine', // Lu comme '0'/'US'
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23818334G',
                'nom' => 'KOUASSI',
                'prenoms' => 'EMMANUELLA GRACE DESIREE',
                'date_naissance' => '2012-07-12',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème1',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23697979J',
                'nom' => 'KOUASSI',
                'prenoms' => 'PEMAUD NESS EDEN',
                'date_naissance' => '2012-08-27',
                'lieu_naissance' => 'COCODY',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème2',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23721361Z',
                'nom' => 'N\'GUESSAN',
                'prenoms' => 'KIRYA MARIE STEPHANIE',
                'date_naissance' => '2012-10-25',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème2',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23232180E',
                'nom' => 'SUBRAMANIAN',
                'prenoms' => 'ROHIT ELI',
                'date_naissance' => '2013-02-15',
                'lieu_naissance' => 'GAGNOA',
                'sexe' => 'Masculin',
                'preced_classe' => '5ème2',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23758784Y',
                'nom' => 'TORO',
                'prenoms' => 'DJOLO MARISSA KETSIA LOREN',
                'date_naissance' => '2012-10-24',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème2',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23791780B',
                'nom' => 'TRAORÉ',
                'prenoms' => 'ASMA FATIMA ZAHARA',
                'date_naissance' => '2013-06-23',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème1',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23899642P',
                'nom' => 'YAYA',
                'prenoms' => 'OWEN LEVI',
                'date_naissance' => '2012-07-31',
                'lieu_naissance' => 'USA',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème2',
                'nationalite' => 'Américaine', // Lu comme '0'/'US'
                'lv2' => 'Espagnol',
            ],
        ];

        // 3. Boucle d'insertion des données avec firstOrCreate pour éviter les doublons
        Eleve::withoutEvents(function () use ($elevesDataHonesty, $classeIdQuatriemeHonesty, $tuteurTelephone, $now) { 
            
            $insertedCount = 0;
            
            foreach ($elevesDataHonesty as $eleve) {
                
                // Détection de redoublement
                $isRedouble = (isset($eleve['redouble']) && $eleve['redouble'] === 1) ? 1 : 0;

                // Données complètes pour l'insertion
                $data = array_merge($eleve, [
                    'classe_id' => $classeIdQuatriemeHonesty, // Utilise l'ID 5
                    'tuteur_telephone' => $tuteurTelephone,
                    'affecte' => false, 
                    'redouble' => $isRedouble,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                // firstOrCreate recherche par 'matricule' et crée si non trouvé
                $eleveModel = Eleve::firstOrCreate(
                    ['matricule' => $eleve['matricule']], // Critère de recherche unique
                    $data                                  // Données si l'élève n'existe pas
                );
                
                // Compter uniquement les élèves nouvellement créés
                if ($eleveModel->wasRecentlyCreated) {
                    $insertedCount++;
                }
            }
            
            $this->command->info($insertedCount . ' élèves de la 4ème Honesty (ID ' . $classeIdQuatriemeHonesty . ') insérés (ou ignorés s\'ils existaient déjà).');
        });
    }
}