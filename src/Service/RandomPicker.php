<?php

namespace App\Service;


class RandomPicker
{
    /**
     * Function wich generates random Index based on the existing indexes in participants array
     *
     * @param $participants
     * @param $maxIndex
     * @return void
     */
    public function randomIndex($participants, $maxIndex)
    {
        // On genere un chiffre aleatoire entre 0 et l'index max de notre tableau
        $randomIndex = rand(0, $maxIndex);

        // On verifie que la clef correspond bien a un index de notre tableau participants
        // et tant que la clef associée au tableau participants n'existe pas on regenere le randomIndex
        while (!array_key_exists($randomIndex, $participants)) {
                
            // on regenere randomIndex
            $randomIndex = rand(0, $maxIndex);

        } 

        // dump('A new key is associated. Key is ' . $randomIndex);
        return $randomIndex;
    }

    /**
     * Function to randomly pick participants and create an array in wich we find a giver associated to a receiver
     *
     * @param $participants
     * @param $maxIndex
     * @return void
     */
    public function randomPicker($participants, $maxIndex)
    {
        // On déclare le tableau participants récuếré par les paramètres
        $participants;

        // On declare un tableau pour stocker les résultats
        $results = [];

        // On prends le participant 1 et on l'associe avec un pariticpant random via l'index random pris precedemment
        foreach ($participants as $currentParticipant) {

            // on choisi un nombre au hasard avec notre fonction randomIndex
            $validRandomIndex = $this->randomIndex($participants, $maxIndex);
            
            // On choisi un participant au hasard
            $randomParticipant = $participants[$validRandomIndex];

            // On fait une association entre le participant Current et le random participant
            $association = [$currentParticipant, $randomParticipant];
            
            $i = 0;
            // On verifie qu'il ne soit pas de la meme famille et que ce ne soit pas lui meme
            while ($currentParticipant == $randomParticipant || $currentParticipant['lastName'] == $randomParticipant['lastName']) {
                
                if ($i < 50) {
                    
                    // On pick un nombre au hasard compris entre 0 et le nb max de participants mais seulement dont l'index est valide
                    $validRandomIndex = $this->randomIndex($participants, $maxIndex);
                    
                    // On choisi un participant au hasard
                    $randomParticipant = $participants[$validRandomIndex];
                    
                    // On fait une association entre le participant Current et le random participant
                    $association = [$currentParticipant, $randomParticipant];
                    dump($association); 
                    
                    // On increment $i
                    $i = $i + 1;

                } if ($i >= 50) {

                    break;
                }
                
            }
            dump('i get out of the 1st while' . 'iterations = ' . $i);


            // Si on a pas pu valider le while precedent on execute ce while avec des conditions moins exigeantes
            while ($currentParticipant == $randomParticipant) {

                $validRandomIndex = $this->randomIndex($participants, $maxIndex);

                $randomParticipant = $participants[$validRandomIndex];

                // TODO AU bout d'un certain nombre d'iterations et si il ne reste qu'un participant dans le tableau
                // TODO on dit au dernier current participant de choisir le receiver de l'association precedente
                // TODO ET on dit a l'avant dernier current participant de choisir le dernier participant comme receiver

                // TODO ALTERNATIVE
                // Quand il ne reste qu'un pariticipant dans le tableau 
                // Si currentParticipant == randomParticipant
                // le current participant choisi le random participant (donc le receiver) de l'associaiton precedente
                //  le giver precedent s'associe au randomParticipant
            }

           
            // if this is the last value in participants array
            if (count($participants) == 1) {

                dump($results);
                dump('this is the last value in participants array');

                // Si currentParticipant == randomParticipant
                // Soit on refait le tirage
                // Soit un modifie les results

                // TEST
                // on recuperes le dernier receiver du tableau results
                $lastArrayReceiver = end($results)['receiver'];
                dump($lastArrayReceiver);

                // TODO on modifie l'entrée du tableau WORKING
                // dd($currentParticipant['firstName']);
                // dd(end($results)['receiver']['firstName']);
                // dd($results[2]['receiver']);
                $results[2]['receiver'] = ['firstName' => $currentParticipant['firstName'], 'lastName' => $currentParticipant['lastName']]; 
                dd($results);

                // on  crée la dernière ligne du tableau et on ajoute lastArrayReceiver comme receiver
                $results[] = ['giver' => $currentParticipant, 'receiver' => $lastArrayReceiver];
                dd($results);

                if ($currentParticipant == $randomParticipant) {
                    
                    // on ajoute l'avant dernier receiver dans la dernière ligne du tableau results
                    // $results[] = ['giver' => $results[]]
                }
            };

            // Si les verifications sont passées on execute le code suivant
            // On insere dans le tableau l'association valide sous la forme giver - receiver
            $results[] = ['giver' => $currentParticipant, 'receiver' => $randomParticipant];
            dump($results);

            // on retire le receiver du tableau des participants par son index
            unset($participants[$validRandomIndex]);
            dump($participants);

        }

        // On transmets les resultats au controller
        // dump($results);
        return $results;  
    }
}