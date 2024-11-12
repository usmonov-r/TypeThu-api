<?php

namespace App\Component;

class WPMCal{

    public function calculateWPM($inputText){
        $duration= 30;
        $charCount = strlen($inputText); 
        $wordCount = $charCount / 5; // 21

        return $duration > 0 ? ($wordCount * 60) / $duration: 0; 


    }
}