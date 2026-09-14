<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Eleve;
use Illuminate\Support\Carbon;

class Eleves4emeLoyaltySeeder extends Seeder
{
    /**
     * Exécute les insertions pour les élèves de la 4ème Loyalty (ID 6).
     */
    public function run(): void
    {
        // 1. Définir l'ID de la classe (ID 6 pour 4ème Loyalty)
        $classeIdQuatriemeLoyalty = 6; 

        // Données communes / par défaut
        $tuteurTelephone = '01 02 12 39 17'; // Téléphone par défaut
        $now = Carbon::now();
        $nationaliteIvoirienne = 'Ivoirienne';

        // 2. Définir les données des 22 élèves de la 4ème Loyalty
        $elevesDataLoyalty = [
            // Mat, Nom & prénoms, Date Naiss, Lieu Naiss, Sexe, Classe Préc, Nat (LV2: ESP=Espagnol)
            [
                'matricule' => '23656165P',
                'nom' => 'ABY',
                'prenoms' => 'ISRAEL MELKISCEDEC',
                'date_naissance' => '2012-03-27',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '5ème2',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23758773G',
                'nom' => 'AKE',
                'prenoms' => 'OBLE HARIEL ERIKA',
                'date_naissance' => '2011-11-13',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème2',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23366343X',
                'nom' => 'CHODATON',
                'prenoms' => 'TALYA ESTHER SEYRAM',
                'date_naissance' => '2012-08-24',
                'lieu_naissance' => 'FRANCE',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème1',
                'nationalite' => 'Française', // Lu comme 'FR' ou '0' dans la colonne Nat
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23783284P',
                'nom' => 'COULIBALY',
                'prenoms' => 'SARAH HAYDEN KEANA MARIE-CHRISTIE',
                'date_naissance' => '2012-08-04',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23758742T',
                'nom' => 'DAKOURI',
                'prenoms' => 'BLESS SYNTYCHE ARIELLE',
                'date_naissance' => '2013-05-26',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème1',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23741546W',
                'nom' => 'DOUMBIA',
                'prenoms' => 'SOKHNA FAOUZIA',
                'date_naissance' => '2013-01-26',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème2',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '22640743U',
                'nom' => 'FINI',
                'prenoms' => 'ALVIN EMMANUEL EDEM',
                'date_naissance' => '2011-08-06',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '5ème',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '2376109H',
                'nom' => 'GJEDË',
                'prenoms' => 'JOSHUA CHRISTIAN',
                'date_naissance' => '2012-05-24',
                'lieu_naissance' => 'USA',
                'sexe' => 'Masculin',
                'preced_classe' => '5ème1',
                'nationalite' => 'Américaine', // Lu comme 'AF' ou '0' dans la colonne Nat
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23366386V',
                'nom' => 'KAVEGÉ',
                'prenoms' => 'EDEM AYOUVI MARIE-PRIELLE YOELA',
                'date_naissance' => '2012-10-04',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23014723C',
                'nom' => 'KOFFI',
                'prenoms' => 'JENNIFER GRACE NOUR',
                'date_naissance' => '2012-12-01',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23765640L',
                'nom' => 'KOFFI',
                'prenoms' => 'SIESSA MERVEILLE EDYNN KETSIA',
                'date_naissance' => '2014-01-25',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '21400000H',
                'nom' => 'KOFFI',
                'prenoms' => 'YADIDIA MESSIE CRISTAL',
                'date_naissance' => '2011-05-07',
                'lieu_naissance' => 'NIGER',
                'sexe' => 'Masculin',
                'preced_classe' => '5ème',
                'nationalite' => $nationaliteIvoirienne, // Non spécifié, défaut Ivoirienne
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23044616J',
                'nom' => 'KOUAKOU',
                'prenoms' => 'PRINCESSE N\'GOUAN CHANCELLE',
                'date_naissance' => '2012-02-09',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23705128J',
                'nom' => 'KOUASSI',
                'prenoms' => 'EHOULAN MICHAEL WILSON',
                'date_naissance' => '2012-05-24',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '5ème2',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23782569T',
                'nom' => 'LIGALI',
                'prenoms' => 'SEKINATH',
                'date_naissance' => '2012-09-03',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème2',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23680987U',
                'nom' => 'MOSSO',
                'prenoms' => 'YANIS MARVEEN',
                'date_naissance' => '2012-10-21',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '5ème',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23501283D',
                'nom' => 'SORO',
                'prenoms' => 'NAGBELE CHEICK HABIB',
                'date_naissance' => '2012-03-27',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '5ème2',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23557415S',
                'nom' => 'TRAORÉ',
                'prenoms' => 'NOURA MYLIE KIRIANE',
                'date_naissance' => '2012-09-11',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème2',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23537676G',
                'nom' => 'VONAN',
                'prenoms' => 'ABLEY JEAN-FRANCOIS LEBLANC',
                'date_naissance' => '2012-03-09',
                'lieu_naissance' => 'GRAND-BASSAM',
                'sexe' => 'Masculin',
                'preced_classe' => '5ème',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23640330L',
                'nom' => 'YEO',
                'prenoms' => 'AMICHIA JOSHUA GNETCHAN',
                'date_naissance' => '2012-08-24',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '5ème',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23557410Z',
                'nom' => 'ZIRIHI',
                'prenoms' => 'DIALLY GUICHOUA DAVID EMMANUEL',
                'date_naissance' => '2012-09-05',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '5ème1',
                'nationalite' => $nationaliteIvoirienne,
                'lv2' => 'Espagnol',
            ],
            [
                'matricule' => '23628698X',
                'nom' => 'ZOROM',
                'prenoms' => 'NAFISSATOU',
                'date_naissance' => '2009-09-07',
                'lieu_naissance' => 'GABJADJI',
                'sexe' => 'Féminin',
                'preced_classe' => '5ème',
                'nationalite' => 'Burkinabé', // Lu comme 'BF' ou '0' dans la colonne Nat
                'lv2' => 'Espagnol',
            ],
        ];

        // 3. Boucle d'insertion des données avec firstOrCreate pour éviter les doublons
        Eleve::withoutEvents(function () use ($elevesDataLoyalty, $classeIdQuatriemeLoyalty, $tuteurTelephone, $now) { 
            
            $insertedCount = 0;
            
            foreach ($elevesDataLoyalty as $eleve) {
                
                // Détection de redoublement (par défaut à 0)
                $isRedouble = (isset($eleve['redouble']) && $eleve['redouble'] === 1) ? 1 : 0;

                // Données complètes pour l'insertion
                $data = array_merge($eleve, [
                    'classe_id' => $classeIdQuatriemeLoyalty, // Utilise l'ID 6
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
            
            $this->command->info($insertedCount . ' élèves de la 4ème Loyalty (ID ' . $classeIdQuatriemeLoyalty . ') insérés (ou ignorés s\'ils existaient déjà).');
        });
    }
}