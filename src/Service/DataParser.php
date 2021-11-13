<?php

namespace App\Service;

class DataParser 
{
    public function dataParse($data, $maxIndex)
    {
        // Declare new array
        $participants = [];

        // Each iteration put a new entry in our array
        for ($i=0; $i <= $maxIndex; $i++) { 
            $participants[] = ['firstName' => $data['firstName' . $i], 'lastName' => $data['lastName' . $i]];
        }
        
        // dump($participants[2]['firstName']);
        return $participants;
        
    }
}