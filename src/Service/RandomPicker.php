<?php

namespace App\Service;

class RandomPicker
{
    
    public function randomPicker($participants, $maxIndex)
    {
        // On mets en place la mecanique d'association aleatoire
        // On pick un nombre au hasard compris entre 0 et le nb max de participants
        $randomIndex = rand(0, $maxIndex);

        // test
        /* dump($randomIndex);
        dump($parsedData);
        dd($parsedData[$randomIndex]); */

        // On declare un tableau
        $results = [];

        // On prends le participant 1 et on l'associe avec un pariticpant random via l'index random pris precedemment
        foreach ($participants as $currentParticipant) {

            // On choisi un participant au hasard
            $randomParticipant = $participants[$randomIndex];
            
            // On fait une association entre le participant Current et le random participant
            $association = [$currentParticipant, $randomParticipant];
            dump($association); 


            // TODO Remplacer le if par une boucle while; Tant que randomParticipant = currentParticipant OU que currentParticipant.lastName = randomParticipant.lastName : chaange le randomIndex du randomParticipant
            // On verifie qu'il ne soit pas de la meme famille et que ce ne soit pas lui meme
            if ($currentParticipant != $randomParticipant && $currentParticipant['lastName'] != $randomParticipant['lastName']) {
               
                dd('it worked');

                // on insere dans le tableau l'association valide
                $results [] = ['giver' => $currentParticipant, 'receiver' => $randomParticipant];

                // on retire le receiver du tableau des participants

            } else {
                // TODO On doit changer le randomParticipant DONC BESOIN DE FAIRE ENTRER LE randomIndex dans la boucle
                // A tester
                $i -= 1;

                dd('it didnt worked');
            }


            dump($results);
        }
        // Si c'est ok on sort le receiver
        // On recommence
        // On les resultats dans un tableau ou dans des variables au controller

        // array :
        // ass1 : partcipant 1, participant 4
    }
}