<?php

namespace App\Service;

class DataParser 
{
    /**
     * Parses the array into a multidimensionnal array
     *
     * @param $data
     * @param $maxIndex
     * @return void
     */
    public function dataParse($data, $maxIndex)
    {
        // Declare new array
        $participants = [];

        // Each iteration put a new entry in our array
        for ($i=0; $i <= $maxIndex; $i++) { 
            $participants[] = ['firstName' => $data['firstName' . $i], 'lastName' => $data['lastName' . $i]];
        }
        
        return $participants;
        
    }
}