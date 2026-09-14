<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Eleve;
use Illuminate\Support\Carbon;

class Eleves3emeDreamSeeder extends Seeder
{
    /**
     * Exécute les insertions pour les élèves de la 3ème Dream (ID 7).
     */
    public function run(): void
    {
        // 1. Définir l'ID de la classe (ID 7 pour 3ème Dream)
        $classeIdTroisiemeDream = 7; 

        // Données communes / par défaut
        $tuteurTelephone = '01 02 12 39 17'; // Téléphone par défaut
        $now = Carbon::now();
        $nationaliteIvoirienne = 'Ivoirienne';
        $lv2NonSpecifiee = ''; // LV2 non spécifiée (chaîne vide)

        // 2. Définir les données des 29 élèves de la 3ème Dream
        $elevesDataDream = [
            // Mat, Nom & prénoms, Date Naiss, Lieu Naiss, Sexe, Classe Préc, Nat (LV2: '' non spécifié)
            [
                'matricule' => '22843895S',
                'nom' => 'ABIOLA',
                'prenoms' => 'CHRIS DANIEL TEMILOYE',
                'date_naissance' => '2011-06-07',
                'lieu_naissance' => 'MARCORY',
                'sexe' => 'Masculin',
                'preced_classe' => '4ème1',
                'nationalite' => 'Nigériane', // NG
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22310885K',
                'nom' => 'AHOUA',
                'prenoms' => 'ISRAEL NEHEMIE',
                'date_naissance' => '2011-08-06',
                'lieu_naissance' => 'ABOBO',
                'sexe' => 'Masculin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22312191F',
                'nom' => 'ALLOGBA',
                'prenoms' => 'AKEBIE MICHAELLE CELIA KELLYS PAULE-ALAINA',
                'date_naissance' => '2011-03-08',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '21845140K',
                'nom' => 'ALLOGBA',
                'prenoms' => 'BADJO MAELYS MARIE-EMMANUELLE VIRGINIE',
                'date_naissance' => '2011-06-07',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22984355H',
                'nom' => 'ASSENG MVENG',
                'prenoms' => 'NOUMEA TAMARA MARIAME IMANE',
                'date_naissance' => '2011-07-18',
                'lieu_naissance' => 'AGBOVILLE',
                'sexe' => 'Féminin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22804885G',
                'nom' => 'ASSOH',
                'prenoms' => 'MATTIYA BLESSING ZOE LYRANE',
                'date_naissance' => '2012-04-18',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22965989D',
                'nom' => 'AVIT',
                'prenoms' => 'PAUL YANIS KIRIAN LOIC',
                'date_naissance' => '2011-12-19',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22807828A',
                'nom' => 'BAKAYOKO',
                'prenoms' => 'PENIEL MARC ISRAEL',
                'date_naissance' => '2011-04-26',
                'lieu_naissance' => 'COCODY',
                'sexe' => 'Masculin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22965992A',
                'nom' => 'BAMONI',
                'prenoms' => 'MARC-DANIEL STEVEN DOGBO',
                'date_naissance' => '2011-03-26',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22901696F',
                'nom' => 'DEMBELE',
                'prenoms' => 'PRINCESSE OUMOU ILIANA',
                'date_naissance' => '2011-05-21',
                'lieu_naissance' => 'PLATEAU',
                'sexe' => 'Féminin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22501917J',
                'nom' => 'DIAKITE',
                'prenoms' => 'ASTOU DJAMILA',
                'date_naissance' => '2013-09-20',
                'lieu_naissance' => 'GUINEE',
                'sexe' => 'Féminin',
                'preced_classe' => '4ème1',
                'nationalite' => 'Guinéenne', // GU
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '2250175X',
                'nom' => 'GNAKOURI',
                'prenoms' => 'DOGBA MARVIN CHRIST ETHAN',
                'date_naissance' => '2013-01-18',
                'lieu_naissance' => 'KOUMASSI',
                'sexe' => 'Masculin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22983268S',
                'nom' => 'GNANDJUE',
                'prenoms' => 'CHRIST JEREMIE',
                'date_naissance' => '2011-12-27',
                'lieu_naissance' => 'YOPOUGON',
                'sexe' => 'Masculin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22927919E',
                'nom' => 'GNIMOU',
                'prenoms' => 'ESTHER NOEMIE',
                'date_naissance' => '2012-03-13',
                'lieu_naissance' => 'PLATEAU',
                'sexe' => 'Féminin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22775365W',
                'nom' => 'GNONNAME',
                'prenoms' => 'SARAH OLA KAREN',
                'date_naissance' => '2011-03-29',
                'lieu_naissance' => 'ANEHO/TOGO',
                'sexe' => 'Féminin',
                'preced_classe' => '4ème1',
                'nationalite' => 'Togolaise', // TG
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22807831R',
                'nom' => 'KAKOU',
                'prenoms' => 'DEREK YANN ETHAN',
                'date_naissance' => '2012-02-26',
                'lieu_naissance' => 'COCODY',
                'sexe' => 'Masculin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22384301E',
                'nom' => 'KAKOU',
                'prenoms' => 'GNABA ISAAC DAVID BLESSING',
                'date_naissance' => '2011-09-25',
                'lieu_naissance' => 'PLATEAU',
                'sexe' => 'Masculin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22962883V',
                'nom' => 'KOUASSI',
                'prenoms' => 'EPHRAIM EDDY RENE',
                'date_naissance' => '2012-03-01',
                'lieu_naissance' => 'ANYAMA',
                'sexe' => 'Masculin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22965733P',
                'nom' => 'KOUASSI',
                'prenoms' => 'DANIEL-ANGE',
                'date_naissance' => '2011-05-23',
                'lieu_naissance' => 'PLATEAU',
                'sexe' => 'Masculin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22983350F',
                'nom' => 'MOBIO',
                'prenoms' => 'LEVI JONATHAN BENI',
                'date_naissance' => '2011-09-06',
                'lieu_naissance' => 'DAOUKRO',
                'sexe' => 'Masculin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22850814J',
                'nom' => 'N\'DRI',
                'prenoms' => 'KOULE OEDEYA RINA TRESOR',
                'date_naissance' => '2012-04-26',
                'lieu_naissance' => 'COTONOU (BENIN)',
                'sexe' => 'Féminin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22073381K',
                'nom' => 'NGORAN',
                'prenoms' => 'ANGE MOREL HURAI',
                'date_naissance' => '2012-05-30',
                'lieu_naissance' => 'DIDIEVI',
                'sexe' => 'Masculin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22957563F',
                'nom' => 'NWYE',
                'prenoms' => 'CHRIS WINNER ONOCHE',
                'date_naissance' => '2011-06-13',
                'lieu_naissance' => 'MARCORY',
                'sexe' => 'Masculin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22401697L',
                'nom' => 'OUYA',
                'prenoms' => 'SOUHADE OPHIRA LILIA',
                'date_naissance' => '2012-10-30',
                'lieu_naissance' => 'ATTECOUBE',
                'sexe' => 'Féminin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22650747W',
                'nom' => 'ROGENE',
                'prenoms' => 'ETHANN NOAH',
                'date_naissance' => '2011-12-06',
                'lieu_naissance' => 'HAITI',
                'sexe' => 'Masculin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22933219F',
                'nom' => 'TOURE',
                'prenoms' => 'IVAN AÏZI',
                'date_naissance' => '2013-02-02',
                'lieu_naissance' => 'DABAKALA',
                'sexe' => 'Masculin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22729422M',
                'nom' => 'TRAORE',
                'prenoms' => 'ANNIELLE RACHELLE',
                'date_naissance' => '2011-11-10',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22929302A',
                'nom' => 'YAO',
                'prenoms' => 'JADE BLESSING LUCE MERAVE',
                'date_naissance' => '2011-03-30',
                'lieu_naissance' => 'COCODY',
                'sexe' => 'Féminin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
            [
                'matricule' => '22851137M',
                'nom' => 'YOLOU',
                'prenoms' => 'CODJOVI MARIE EDEN OLIVIA',
                'date_naissance' => '2011-03-25',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => '4ème1',
                'nationalite' => $nationaliteIvoirienne, // IV
                'lv2' => $lv2NonSpecifiee,
            ],
        ];

        // 3. Boucle d'insertion des données avec firstOrCreate pour éviter les doublons
        Eleve::withoutEvents(function () use ($elevesDataDream, $classeIdTroisiemeDream, $tuteurTelephone, $now) { 
            
            $insertedCount = 0;
            
            foreach ($elevesDataDream as $eleve) {
                
                // Détection de redoublement (si la colonne était présente)
                $isRedouble = (isset($eleve['redouble']) && $eleve['redouble'] === 1) ? 1 : 0;

                // Données complètes pour l'insertion
                $data = array_merge($eleve, [
                    'classe_id' => $classeIdTroisiemeDream, // Utilise l'ID 7
                    'tuteur_telephone' => $tuteurTelephone,
                    'affecte' => false, 
                    'redouble' => $isRedouble,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                // firstOrCreate recherche par 'matricule' et crée si non trouvé
                $eleveModel = Eleve::firstOrCreate(
                    ['matricule' => $eleve['matricule']], // Critère de recherche unique
                    $data     // Données si l'élève n'existe pas
                );
                
                // Compter uniquement les élèves nouvellement créés
                if ($eleveModel->wasRecentlyCreated) {
                    $insertedCount++;
                }
            }
            
            $this->command->info($insertedCount . ' élèves de la 3ème Dream (ID ' . $classeIdTroisiemeDream . ') insérés (ou ignorés s\'ils existaient déjà).');
        });
    }
}