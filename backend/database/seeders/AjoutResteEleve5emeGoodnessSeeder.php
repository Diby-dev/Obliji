<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Eleve;
use Illuminate\Support\Carbon;

class AjoutResteEleve5emeGoodnessSeeder extends Seeder
{
    /**
     * Exécute les insertions pour les 10 élèves restants de la 5ème Goodness.
     */
    public function run(): void
    {
        // 1. Définir l'ID de la classe
        $classeIdCinquiemeGoodness = 3; 

        // Données communes / par défaut
        $tuteurTelephone = '01 02 12 39 17'; 
        $now = Carbon::now();

        // 2. Définir les données des 10 élèves restants (index 8 à 17 de la liste initiale)
        $elevesDataRestants = [
            // No 9 : KATCHE - Matricule corrigé
            [
                'matricule' => '24146745K', 
                'nom' => 'KATCHE',
                'prenoms' => 'YOBOUET KONAN MELVIN EVANS STEPHEN',
                'date_naissance' => '2013-07-08',
                'lieu_naissance' => 'COCODY',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
            // No 10 : KOFFI EBAH
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
            // No 11 : KOFFI KYMRYD
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
            // No 12 : KOUAKOU
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
            // No 13 : KRA
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
            // No 14 : LOHOURI
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
            // No 15 : NINDJIN
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
            // No 16 : SOMDO
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
            // No 17 : TRAORE
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
            // No 18 : YAO
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

        // 3. Insertion des données
        Eleve::withoutEvents(function () use ($elevesDataRestants, $classeIdCinquiemeGoodness, $tuteurTelephone, $now) { 
            
            $elevesFormatted = array_map(function ($eleve) use ($classeIdCinquiemeGoodness, $tuteurTelephone, $now) {
                
                // Par défaut, redoublement est false (0)
                $isRedouble = $eleve['redouble'] ?? 0;

                return array_merge($eleve, [
                    'classe_id' => $classeIdCinquiemeGoodness, 
                    'tuteur_telephone' => $tuteurTelephone,
                    'affecte' => false, 
                    'redouble' => $isRedouble,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }, $elevesDataRestants);

            // Cette fois, on utilise insert(), car on suppose que ces 10 élèves sont bien manquants
            DB::table('eleves')->insert($elevesFormatted);
            
            $this->command->info(count($elevesDataRestants) . ' élèves restants de la 5ème Goodness (ID ' . $classeIdCinquiemeGoodness . ') insérés avec succès.');
        });
    }
}