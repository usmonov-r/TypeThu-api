<?php

namespace App\Component;

use App\Entity\TestResult;


class AccuracyCal {

    public function calculateAccuracy($incorrectChar, $expectedText,)
    {
        $totalCharacters = strlen($expectedText); 
        $incorrectChar = (int)$incorrectChar;
        return $totalCharacters > 0 ? (($totalCharacters - $incorrectChar) / $totalCharacters) * 100: 0;
        
    }
}
