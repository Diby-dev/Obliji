<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Eleve;
use Illuminate\Support\Carbon;

class ElevesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // ID de la classe '6ème Glory' confirmé
        $classeIdSixiemeGlory = 1; 

        // Téléphone unique pour tous les tuteurs
        $tuteurTelephone = '01 02 12 39 17';
        
        $now = Carbon::now();
        
        // Données avec Nom et Prénoms séparés et Nationalité Complète
        $elevesData = [
            // Mat, Nom & Prénoms (à séparer), Date Naiss, Lieu Naiss, Sexe, Classe Préc, Nationalité
            [
                'matricule' => '25175914R',
                'nom' => 'ABIOLA',
                'prenoms' => 'JONATHAN ABIOYE OYELAHAN TUANI',
                'date_naissance' => '2014-12-22',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25088517U',
                'nom' => 'ADBANGBO',
                'prenoms' => 'KOUTOUAN JOY-HOREB DANIEL',
                'date_naissance' => '2014-10-22',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25111697Q',
                'nom' => 'AHOUA',
                'prenoms' => 'SCHECKINAEL ELIE MOISE',
                'date_naissance' => '2014-11-16',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25324521V',
                'nom' => 'ANKEMAN',
                'prenoms' => 'ARYEL MARIE ROSAIRE',
                'date_naissance' => '2015-02-01',
                'lieu_naissance' => 'GRAND-BASSAI',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25031108X',
                'nom' => 'APPIA',
                'prenoms' => 'ETHAN JOSHUA',
                'date_naissance' => '2014-02-28',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25019765T',
                'nom' => 'BABO',
                'prenoms' => 'ARISTIDE WAAZY PRECIEUSE',
                'date_naissance' => '2015-03-29',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25173576E',
                'nom' => 'BENSON',
                'prenoms' => 'EZOUA MOISE-EMETH SONGUE',
                'date_naissance' => '2015-03-25',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24353176B',
                'nom' => 'COULIBALY',
                'prenoms' => 'PENA BASSIDI DAVID JADEN',
                'date_naissance' => '2013-07-08',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => '6ème r', 
                'nationalite' => 'Ivoirienne',
                'redouble' => true,
            ],
            [
                'matricule' => '25171803Y',
                'nom' => 'COULIBALY',
                'prenoms' => 'SIE OSMANE ILHAN',
                'date_naissance' => '2013-02-14',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25192502W',
                'nom' => 'DASSI',
                'prenoms' => 'KARL-EMMANUEL MICHEL OLAKOULEYIN',
                'date_naissance' => '2014-05-09',
                'lieu_naissance' => 'CANADA',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25175920Y',
                'nom' => 'DIBY',
                'prenoms' => 'CHIRA YOUNISSE HANNIEL',
                'date_naissance' => '2014-11-17',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25031121D',
                'nom' => 'GRAZA',
                'prenoms' => 'OUZIGNON ARIEL EVAN CHAGA',
                'date_naissance' => '2014-07-13',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '41000000J',
                'nom' => 'GUEDE',
                'prenoms' => 'JAYDEN CHRIS LEDJIM',
                'date_naissance' => '2014-07-15',
                'lieu_naissance' => 'USA',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25052409W',
                'nom' => 'HOUNDOGA',
                'prenoms' => 'GODLOVE FERRY BLANCHARD',
                'date_naissance' => '2015-04-27',
                'lieu_naissance' => 'BENIN',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Béninoise',
            ],
            [
                'matricule' => '25175916T',
                'nom' => 'KOUADIO',
                'prenoms' => 'ANYCOIME CHRIS YORAM',
                'date_naissance' => '2013-06-05',
                'lieu_naissance' => 'TOGO',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25020274T',
                'nom' => 'KOUADIO',
                'prenoms' => 'NOADIYA JEANNE CHLOE',
                'date_naissance' => '2014-09-28',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25175980N',
                'nom' => 'KOUAKOU',
                'prenoms' => 'SLESSIAH AURELLA',
                'date_naissance' => '2014-01-19',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25175979M',
                'nom' => 'KOUAME',
                'prenoms' => 'KATCHENEY SOURALEY GRACE YASMINA',
                'date_naissance' => '2014-01-26',
                'lieu_naissance' => 'YAMOUSSOUKRO',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25386387R',
                'nom' => 'KOUAME',
                'prenoms' => 'KONAN GUELADE JOCELYNE MARCELLE',
                'date_naissance' => '2014-08-30',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25042181C',
                'nom' => 'KRA',
                'prenoms' => 'KOUAKOU CHRIS-YVAN EMMANUEL SCHOUMYE',
                'date_naissance' => '2015-05-19',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25111111C',
                'nom' => 'LOBGUE',
                'prenoms' => 'KEYLA',
                'date_naissance' => '2012-12-21',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24221453P',
                'nom' => "N'GUESSAN",
                'prenoms' => 'NOYA MARIE-MAELYS AKISSI',
                'date_naissance' => '2013-08-27',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25176202D',
                'nom' => 'TIMITE',
                'prenoms' => 'NERIJAH SAIDA',
                'date_naissance' => '2013-12-18',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25175075D',
                'nom' => 'VONAN',
                'prenoms' => 'AKOUBA JESSICA MARIE LOREINE',
                'date_naissance' => '2014-02-27',
                'lieu_naissance' => 'GRAND-BASSAI',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25175965W',
                'nom' => 'YANA',
                'prenoms' => 'PONDY ALISON MARIE JOHANNE',
                'date_naissance' => '2014-10-24',
                'lieu_naissance' => 'BURKINA FASO',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Burkinabé',
            ],
            [
                'matricule' => '25175358M',
                'nom' => 'YOBO',
                'prenoms' => 'MEHIRA DANIELLA EMMANUELLA',
                'date_naissance' => '2013-07-26',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
        ];

        Eleve::withoutEvents(function () use ($elevesData, $classeIdSixiemeGlory, $tuteurTelephone, $now) { 
            
            $elevesFormatted = array_map(function ($eleve) use ($classeIdSixiemeGlory, $tuteurTelephone, $now) {
                // Détecte si l'élève est redoublant basé sur '6ème r' dans la classe précédente
                $isRedouble = $eleve['redouble'] ?? (str_contains($eleve['preced_classe'], 'r') ? true : false);

                return array_merge($eleve, [
                    'classe_id' => $classeIdSixiemeGlory,
                    'tuteur_telephone' => $tuteurTelephone,
                    'affecte' => true, 
                    'redouble' => $isRedouble,
                    // Les autres champs 'nullable' sont omis et seront NULL
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }, $elevesData);

            DB::table('eleves')->insert($elevesFormatted);
        }); 
    }
}