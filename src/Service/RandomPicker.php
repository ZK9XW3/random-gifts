<?php

namespace App\Service;

class RandomPicker 
{
    public function dataParser($data)
    {
        // on recuperes les data sous forme de tableau
        // on verifie les data (pas de champs vide) 
        // et on associe  les first name et last name pour faire des participants
        
    }

    public function randomPicker()
    {
        // On mets en place la mecanique d'association aleatoire
        // On pick un nombre au hasard compris entre 0 et le nb max de participants
        // On prends le participant 1 et on l'associe avec un pariticpant random via l'index random pris precedemment
        // On verifie qu'il ne soit pas de la meme famille et que ce ne soit pas lui meme
        // Si c'est ok on sort le receiver
        // On recommence
        // On les resultats dans un tableau ou dans des variables au controller
    }

}