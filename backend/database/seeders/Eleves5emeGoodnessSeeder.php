<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Eleve; // Assurez-vous que le modèle Eleve est importé
use Illuminate\Support\Carbon;

class Eleves5emeGoodnessSeeder extends Seeder
{
    /**
     * Exécute les insertions pour les élèves de la 5ème Goodness (ID 3).
     *
     * Utilise Eleve::firstOrCreate pour éviter l'erreur de contrainte unique 
     * si le seeder est exécuté plusieurs fois.
     */
    public function run(): void
    {
        // 1. Définir l'ID de la classe 
        $classeIdCinquiemeGoodness = 3; 

        // Données communes / par défaut
        $tuteurTelephone = '01 02 12 39 17'; 
        $now = Carbon::now();

        // 2. Définir les données des 18 élèves de la 5ème Goodness
        // ATTENTION : Le matricule de KATCHE (ligne 9) est corrigé à 24146745K.
        $elevesDataGoodness = [
            // Mat, Nom & prénoms, Date Naiss, Lieu Naiss, Sexe, Classe Préc, Nationalité
            [
                'matricule' => '24487590D',
                'nom' => 'ADOU',
                'prenoms' => 'MARIE HORTENSE ESTHER ELIORA',
                'date_naissance' => '2014-07-11',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '6ème2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24077272V',
                'nom' => 'AGAIN',
                'prenoms' => 'TAOULE JEAN-JERIEL',
                'date_naissance' => '2013-10-03',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24077246S',
                'nom' => 'AGOUA',
                'prenoms' => 'NOAM ANGE KAMIEL',
                'date_naissance' => '2013-07-11',
                'lieu_naissance' => 'PLATEAU',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24525480Z',
                'nom' => 'AKPAGNI',
                'prenoms' => 'ESMEL LOHOUES ANGE EYAL',
                'date_naissance' => '2012-05-13',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24340595T',
                'nom' => 'BAKAM',
                'prenoms' => 'FOTSO HELENE JOYCE',
                'date_naissance' => '2013-06-25',
                'lieu_naissance' => 'CAMEROUN',
                'sexe' => 'Féminin',
                'preced_classe' => '6ème2',
                'nationalite' => 'Camerounaise',
            ],
            [
                'matricule' => '24250021R',
                'nom' => 'DE YANEL',
                'prenoms' => 'CHRIST EDEN',
                'date_naissance' => '2014-07-10',
                'lieu_naissance' => 'COCODY',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24157532K',
                'nom' => 'DOMORAUD',
                'prenoms' => 'KIRANE OTHNIEL MESSI',
                'date_naissance' => '2013-09-07',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24410406B',
                'nom' => 'KASSIKAN',
                'prenoms' => 'KHALIL EMMANUEL NOAH',
                'date_naissance' => '2013-08-19',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24146745K', // 🚨 MATRICULE CORRIGÉ
                'nom' => 'KATCHE',
                'prenoms' => 'YOBOUET KONAN MELVIN EVANS STEPHEN',
                'date_naissance' => '2013-07-08',
                'lieu_naissance' => 'COCODY',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24076089K',
                'nom' => 'KOFFI',
                'prenoms' => 'EBAH MAELLE SHARONE ANNE DENISE',
                'date_naissance' => '2012-07-26',
                'lieu_naissance' => 'COCODY',
                'sexe' => 'Féminin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24077265N',
                'nom' => 'KOFFI',
                'prenoms' => 'KYMRYD ANAEL SUZY',
                'date_naissance' => '2013-03-20',
                'lieu_naissance' => 'MONTREAL',
                'sexe' => 'Féminin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24077304F',
                'nom' => 'KOUAKOU',
                'prenoms' => 'MIENRASSEOU ABEBY ELIENA',
                'date_naissance' => '2013-05-02',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '6ème2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24055763R',
                'nom' => 'KRA',
                'prenoms' => 'KOFFI KYLLIAN SASHA',
                'date_naissance' => '2013-03-22',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24149851L',
                'nom' => 'LOHOURI',
                'prenoms' => 'BI GOULI RUBEN',
                'date_naissance' => '2013-06-11',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24260389L',
                'nom' => 'NINDJIN',
                'prenoms' => 'WDOUBA KENZHA HELENE',
                'date_naissance' => '2012-12-31',
                'lieu_naissance' => 'GRAND-BASSAM',
                'sexe' => 'Féminin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24077240L',
                'nom' => 'SOMDO',
                'prenoms' => 'KETSIA ANGE ESTHER',
                'date_naissance' => '2013-03-18',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '6ème2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24397139X',
                'nom' => 'TRAORE',
                'prenoms' => 'MILIE ELIORA NYRIADE',
                'date_naissance' => '2013-10-15',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '6ème2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24149306T',
                'nom' => 'YAO',
                'prenoms' => 'TANOH KARL HENDRIX AXEL',
                'date_naissance' => '2012-09-25',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
        ];

        // 3. Boucle d'insertion des données avec firstOrCreate pour éviter les doublons
        Eleve::withoutEvents(function () use ($elevesDataGoodness, $classeIdCinquiemeGoodness, $tuteurTelephone, $now) { 
            
            $insertedCount = 0;
            
            foreach ($elevesDataGoodness as $eleve) {
                
                // Détection de redoublement
                // Note : Par défaut, de 6ème vers 5ème n'est pas un redoublement (redouble = 0)
                $isRedouble = (isset($eleve['redouble']) && $eleve['redouble'] === 1) ? 1 : 0;

                // Données complètes pour l'insertion
                $data = array_merge($eleve, [
                    'classe_id' => $classeIdCinquiemeGoodness, 
                    'tuteur_telephone' => $tuteurTelephone,
                    'affecte' => false, // 0
                    'redouble' => $isRedouble, // 0 par défaut ici
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                // Utiliser firstOrCreate : Recherche par 'matricule'. S'il existe, il renvoie l'objet existant. 
                // S'il n'existe pas, il crée l'enregistrement avec $data.
                $eleveModel = Eleve::firstOrCreate(
                    ['matricule' => $eleve['matricule']], // Critère de recherche unique
                    $data                                  // Données si l'élève n'existe pas
                );
                
                // Compter uniquement les élèves nouvellement créés
                if ($eleveModel->wasRecentlyCreated) {
                    $insertedCount++;
                }
            }
            
            $this->command->info($insertedCount . ' élèves de la 5ème Goodness (ID ' . $classeIdCinquiemeGoodness . ') insérés (ou ignorés s\'ils existaient déjà).');
        });
    }
}