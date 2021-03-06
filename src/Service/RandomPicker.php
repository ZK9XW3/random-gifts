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

        //! For Each
        // On prends le participant et on l'associe avec un pariticpant random
        foreach ($participants as $currentParticipant) {

            // dump('start a new foreach iteration');

            // on choisi un nombre au hasard avec notre fonction randomIndex
            $validRandomIndex = $this->randomIndex($participants, $maxIndex);
            
            // On choisi un participant au hasard
            $randomParticipant = $participants[$validRandomIndex];

            // On fait une association servant uniquement au test, entre le participant Current et le random participant
            $association = [$currentParticipant, $randomParticipant];
            // dump($association);
            // dump("there are " . count($participants) . " participants left");

            //! if this is the last value in participants array
            if (count($participants) == 1) {

                // dump('this is the last value in participants array');
                // dump($currentParticipant, $randomParticipant);

                //! Si currentParticipant == randomParticipant on modifie le tableau results // on aurait pu refaire le tirage aussi
                if ($currentParticipant == $randomParticipant) {
                    
                    // dump('switching results');

                    // on recuperes le dernier receiver du tableau results
                    $lastArrayReceiver = end($results)['receiver'];
                    // dump($lastArrayReceiver);

                    // On recuperes la clef du dernier element du tableau results
                    $lastKeyResults = array_key_last($results);
                    // dump("the key of the last array element is " . $lastKeyResults);

                    // On modifie l'entrée du tableau pout mettre notre current participant comme receiver
                    $results[$lastKeyResults]['receiver'] = ['firstName' => $currentParticipant['firstName'], 'lastName' => $currentParticipant['lastName']]; 
                    // dump($results);

                    // on  crée une nouvelle = la dernière ligne du tableau et on ajoute lastArrayReceiver comme receiver
                    $results[] = ['giver' => $currentParticipant, 'receiver' => $lastArrayReceiver];
                    // dump($results);    

                } 
                //! if currentParticipant != randomParticipant
                else {

                    // dump("in the else of the last participant if");

                    // On insere dans le tableau l'association valide sous la forme giver - receiver
                    $results[] = ['giver' => $currentParticipant, 'receiver' => $randomParticipant];
                    // dump($results);

                    // on retire le receiver du tableau des participants par son index
                    unset($participants[$validRandomIndex]);
                    // dump($participants);
                }
            };

            //! Si le nombre de participants est different de 0 et 1
            if (count($participants) != 0 && count($participants) != 1) {

                //! while with hard constraints = not the same last name
                // On initialise un index pour le while
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
                        // dump($association);

                        // On increment $i
                        $i = $i + 1;
                    }
                    if ($i >= 50) {
                        // Si on a tester 50 fois sans trouver de solution on break du while
                        break;
                    }
                
                }
                // dump('i get out of the hard while after iterations = ' . $i);
            
            
                //! while with lightest constraints = only makes that currentParticipant != randomParticipant
                // Si on a pas pu valider le while precedent on execute ce while avec des conditions moins exigeantes
                while ($currentParticipant == $randomParticipant) {

                    // dump("in the easy while");

                    $validRandomIndex = $this->randomIndex($participants, $maxIndex);

                    $randomParticipant = $participants[$validRandomIndex];
                }

                // dump($currentParticipant, $randomParticipant);

                //! Inserting in results and removing from participants
                // On insere dans le tableau l'association valide sous la forme giver - receiver
                $results[] = ['giver' => $currentParticipant, 'receiver' => $randomParticipant];
                // dump($results);

                // on retire le receiver du tableau des participants par son index
                unset($participants[$validRandomIndex]);
                // dump($participants);

            }
        }

        // On transmets les resultats au controller
        return $results;  
    }
}