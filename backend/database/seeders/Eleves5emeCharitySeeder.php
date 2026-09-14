<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Eleve;
use Illuminate\Support\Carbon;

class Eleves5emeCharitySeeder extends Seeder
{
    /**
     * Exécute les insertions pour les élèves de la 5ème Charity (ID 4).
     */
    public function run(): void
    {
        // 1. Définir l'ID de la classe (Supposons ID 4 pour 5ème Charity)
        $classeIdCinquiemeCharity = 4; 

        // Données communes / par défaut
        $tuteurTelephone = '01 02 12 39 17'; // Téléphone par défaut
        $now = Carbon::now();

        // 2. Définir les données des 19 élèves de la 5ème Charity
        $elevesDataCharity = [
            // Mat, Nom & prénoms, Date Naiss, Lieu Naiss, Sexe, Classe Préc, Nationalité
            [
                'matricule' => '24485837Q',
                'nom' => 'ADEPO',
                'prenoms' => 'SHAILLY MARIE ODILE SOPIE MOYAYÉ',
                'date_naissance' => '2014-10-12',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '18514018F',
                'nom' => 'ALLOH',
                'prenoms' => 'AKE AUGUSTIN YANN ETHAN',
                'date_naissance' => '2012-09-27',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24233997P',
                'nom' => 'APPIA',
                'prenoms' => 'KALEB JONATHAN',
                'date_naissance' => '2013-01-28',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24397129Y',
                'nom' => 'ASSI',
                'prenoms' => 'RANIA COLOMBE BLESSINGS',
                'date_naissance' => '2013-05-14',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24234393S',
                'nom' => 'BELUGRE',
                'prenoms' => 'CHRIS-DAVID HIDDEKEL KADIE',
                'date_naissance' => '2013-11-28',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24409549F',
                'nom' => 'DE KRIS-YLIAM',
                'prenoms' => 'EMMANUEL',
                'date_naissance' => '2012-10-06',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24075128Q',
                'nom' => 'DJÉGNAN',
                'prenoms' => 'REHOBOTH NOELLIE',
                'date_naissance' => '2013-11-14',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24225490B',
                'nom' => 'GNONNAME',
                'prenoms' => 'MARIE CHRISTY SAMANTHA',
                'date_naissance' => '2014-10-10',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '6ème2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24001721E',
                'nom' => 'KADJO',
                'prenoms' => 'THOKOUT DAVID ETHAN',
                'date_naissance' => '2013-11-19',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24070423A',
                'nom' => 'KÉBÉ',
                'prenoms' => 'SARTA FATIHA',
                'date_naissance' => '2013-12-05',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '6ème2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24353175J',
                'nom' => 'KONAN',
                'prenoms' => 'AFFOUE HAYANA MARIE-EMMANUELLA',
                'date_naissance' => '2013-06-15',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '6ème2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24145853Q',
                'nom' => 'KONAN',
                'prenoms' => 'HANNIELL WISDOM KENAN',
                'date_naissance' => '2013-06-22',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24397135G',
                'nom' => 'KOUAMÉLA',
                'prenoms' => 'ESSE KENDRICK KILYAN',
                'date_naissance' => '2014-01-11',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24073129S',
                'nom' => 'MANSILLA',
                'prenoms' => 'ETHAN YEDIDIYA EUGENE KIYELMANN',
                'date_naissance' => '2013-01-19',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24002293W',
                'nom' => 'SOHOU',
                'prenoms' => 'BIENVENUE NATHANAEL',
                'date_naissance' => '2012-12-04',
                'lieu_naissance' => 'DIVO',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24397131E',
                'nom' => 'TOTY',
                'prenoms' => 'JERIEL SYNTHICHE',
                'date_naissance' => '2013-05-19',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24077298J',
                'nom' => 'TOURÉ',
                'prenoms' => 'EMMANUELLA REBECCA MIYLKA TOURÉ',
                'date_naissance' => '2014-03-01',
                'lieu_naissance' => 'COCODY',
                'sexe' => 'Féminin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24397380E',
                'nom' => 'YAO',
                'prenoms' => 'MESSOU YANN ELIRONE JAYDEN',
                'date_naissance' => '2013-08-08',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème1',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24148300E',
                'nom' => 'ZIRIGNON',
                'prenoms' => 'MARIE URIELLE',
                'date_naissance' => '2013-10-04',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '6ème2',
                'nationalite' => 'Ivoirienne',
            ],
        ];

        // 3. Boucle d'insertion des données avec firstOrCreate pour éviter les doublons
        Eleve::withoutEvents(function () use ($elevesDataCharity, $classeIdCinquiemeCharity, $tuteurTelephone, $now) { 
            
            $insertedCount = 0;
            
            foreach ($elevesDataCharity as $eleve) {
                
                // Détection de redoublement
                $isRedouble = (isset($eleve['redouble']) && $eleve['redouble'] === 1) ? 1 : 0;

                // Données complètes pour l'insertion
                $data = array_merge($eleve, [
                    'classe_id' => $classeIdCinquiemeCharity, // Utilise l'ID 4
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
            
            $this->command->info($insertedCount . ' élèves de la 5ème Charity (ID ' . $classeIdCinquiemeCharity . ') insérés (ou ignorés s\'ils existaient déjà).');
        });
    }
}