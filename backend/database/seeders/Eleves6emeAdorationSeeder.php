<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // N'oubliez pas l'import
use App\Models\Eleve; // N'oubliez pas l'import
use Illuminate\Support\Carbon; // N'oubliez pas l'import

class Eleves6emeAdorationSeeder extends Seeder
{
    /**
     * Exécute les insertions pour les élèves de la 6ème Adoration (ID 2).
     */
    public function run(): void
    {
        // 1. Définir l'ID de la classe (confirmé par l'utilisateur à 2)
        $classeIdSixiemeAdoration = 2; 

        // Données communes / par défaut
        // Nous réutilisons le même numéro de téléphone que dans les autres Seeders
        $tuteurTelephone = '01 02 12 39 17'; 
        $now = Carbon::now();

        // 2. Définir les données des 26 élèves de la 6ème Adoration
        $elevesDataAdoration = [
            // Mat, Nom & prénoms, Date Naiss, Lieu Naiss, Sexe, Classe Préc, Redouble, Nationalité (Nettoyées du tableau)
            [
                'matricule' => '25175954K',
                'nom' => 'ADJOKPOTA',
                'prenoms' => 'ELORA GAELLE',
                'date_naissance' => '2014-02-27',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25042627E',
                'nom' => 'ADOM',
                'prenoms' => 'TANOH MARIE-CHANCELLE',
                'date_naissance' => '2014-02-22',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25175949D',
                'nom' => 'ADON',
                'prenoms' => 'MEKOUDACHE GUÉHANIN OREN',
                'date_naissance' => '2014-04-20',
                'lieu_naissance' => 'YAMOUSSOUKRO',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24700000X',
                'nom' => 'AHIOUNKPE',
                'prenoms' => 'MATHYS LOAN ELISAEL ENAGNON',
                'date_naissance' => '2014-06-02',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25000000P',
                'nom' => 'AHOUA',
                'prenoms' => 'ANANKAN NATHAN JASON',
                'date_naissance' => '2014-10-04',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25366809L',
                'nom' => 'ANON',
                'prenoms' => 'MEL MARLYSE KYLIE KENDALL',
                'date_naissance' => '2014-10-13',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25030259V',
                'nom' => 'ASSOH',
                'prenoms' => 'SOPHIA JOYCE DUNAMIS',
                'date_naissance' => '2014-10-23',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '51000000C',
                'nom' => 'BOUHOM',
                'prenoms' => 'KOUDJOU KAELA CHARLOTTE CHELSY',
                'date_naissance' => '2013-10-10',
                'lieu_naissance' => 'CAMEROUN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Camerounaise',
            ],
            [
                'matricule' => '25002176L',
                'nom' => 'DIALLO',
                'prenoms' => 'BAKARA DAVID MARC ELIA',
                'date_naissance' => '2014-12-12',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25175918V',
                'nom' => 'DOUMBIA',
                'prenoms' => 'MARIAM CHERIFA',
                'date_naissance' => '2015-05-03',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25275997B',
                'nom' => 'GILLIE',
                'prenoms' => 'HANNAH KATE',
                'date_naissance' => '2014-04-17',
                'lieu_naissance' => 'TOGO',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Togolaise',
            ],
            [
                'matricule' => '25175987V',
                'nom' => 'GNIMOU',
                'prenoms' => 'ARIEL CHRIST-ROLAND',
                'date_naissance' => '2014-02-02',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25191843F',
                'nom' => 'GROGA',
                'prenoms' => 'ELORA EMMANUELLE',
                'date_naissance' => '2014-10-23',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25118290G',
                'nom' => 'KAKADIE',
                'prenoms' => 'NEMLIN GRACE-REBECCA',
                'date_naissance' => '2015-01-21',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25274474W',
                'nom' => 'KELI',
                'prenoms' => 'PENIEL ORNIELLA',
                'date_naissance' => '2014-04-20',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25211417G',
                'nom' => 'KRA',
                'prenoms' => 'MOAYE MARIE PRISCILLE NOELLE',
                'date_naissance' => '2014-03-07',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25191846J',
                'nom' => 'KYERAA',
                'prenoms' => 'AMA PRUNELLE VANESSA',
                'date_naissance' => '2014-07-21',
                'lieu_naissance' => 'AU GHANA',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25175970M',
                'nom' => 'MAHEFARIVO',
                'prenoms' => 'IMENDRIKA FENOSOA',
                'date_naissance' => '2015-03-03',
                'lieu_naissance' => 'MADAGASCAR',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Malagasy', // Nationalité complète: Malagasy (Madagascar)
            ],
            [
                'matricule' => '25176223B',
                'nom' => 'MONE',
                'prenoms' => 'KEREN DIVINE SHEKINAILE',
                'date_naissance' => '2014-11-07',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25194184E',
                'nom' => "N'GUESSAN",
                'prenoms' => 'KLOMIEN ELIE MARVEL',
                'date_naissance' => '2015-02-17',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25276369G',
                'nom' => 'OBLE',
                'prenoms' => 'DANIEL ELIAS',
                'date_naissance' => '2014-06-12',
                'lieu_naissance' => 'FRANCE',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Française',
            ],
            [
                'matricule' => '25234060T',
                'nom' => 'OUATTARA',
                'prenoms' => 'ISAAC NESS-ETHAN',
                'date_naissance' => '2014-11-19',
                'lieu_naissance' => 'SAN PEDRO',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25173833D',
                'nom' => 'OUATTARA',
                'prenoms' => 'OTHNIEL MARIE EPHRAIM',
                'date_naissance' => '2014-12-24',
                'lieu_naissance' => 'BINGERVILLE',
                'sexe' => 'Féminin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '24463739J',
                'nom' => 'OUEGNIN',
                'prenoms' => 'APLOPLIO NELIA MARIE OLIVE',
                'date_naissance' => '2014-03-25',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Féminin',
                // Cet élève est un redoublant car "6ème r" est indiqué comme classe précédente
                'preced_classe' => '6ème r', 
                'nationalite' => 'Ivoirienne',
                'redouble' => true, // Ajout explicite pour plus de clarté
            ],
            [
                'matricule' => '24410057V',
                'nom' => 'POKOU',
                'prenoms' => 'DIBY NOLANN YANNIS MARC IVOIRE',
                'date_naissance' => '2013-08-17',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
            [
                'matricule' => '25019697B',
                'nom' => 'TANOH',
                'prenoms' => 'OI TANOH MARC-ELIE HEAVEN',
                'date_naissance' => '2014-08-03',
                'lieu_naissance' => 'ABIDJAN',
                'sexe' => 'Masculin',
                'preced_classe' => 'CM2',
                'nationalite' => 'Ivoirienne',
            ],
        ];

        // 3. Boucle d'insertion des données
        Eleve::withoutEvents(function () use ($elevesDataAdoration, $classeIdSixiemeAdoration, $tuteurTelephone, $now) { 
            
            $elevesFormatted = array_map(function ($eleve) use ($classeIdSixiemeAdoration, $tuteurTelephone, $now) {
                
                // Détecte le redoublement si non spécifié, basé sur la classe précédente
                $isRedouble = $eleve['redouble'] ?? (str_contains($eleve['preced_classe'], 'r') ? true : false);

                return array_merge($eleve, [
                    'classe_id' => $classeIdSixiemeAdoration,
                    'tuteur_telephone' => $tuteurTelephone,
                    'affecte' => false, // 🚨 MIS À JOUR : L'élève n'est pas affecté
                    'redouble' => $isRedouble,
                    // Les autres champs 'nullable' sont omis et seront NULL
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }, $elevesDataAdoration);

            DB::table('eleves')->insert($elevesFormatted);
            
            $this->command->info(count($elevesDataAdoration) . ' élèves de la 6ème Adoration (ID ' . $classeIdSixiemeAdoration . ') insérés avec succès.');
        });
    }
}