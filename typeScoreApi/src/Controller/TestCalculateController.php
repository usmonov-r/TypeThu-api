<?php

namespace App\Controller;

use App\Entity\TestResult;
use DateTimeZone;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Clock\DatePoint;
use Doctrine\ORM\EntityManagerInterface;  
use App\Repository\TestResultRepository;
use App\Repository\TextSnippetRepository;
use App\Component\AccuracyCal;
use App\Component\WPMCal;




class TestCalculateController extends AbstractController{

    public function __construct(
        private AccuracyCal $accuracyCal,
        private TextSnippetRepository $textRepo,
        private EntityManagerInterface $entityManager,
        private WPMCal $wpmCal,
        ){}
    


    public function __invoke(TestResult $testResult): TestResult{ 
        $inputText = $testResult->getInputText();
        $incorrectChar = $testResult->getIncorrectChar();
        $duration = $testResult->getDuration();
        $textSnipped = $testResult->getTextSnippet();
        $textSnippetId = $testResult->getTextSnippet()->getId();
        if(empty($textSnippetId) || !is_numeric($textSnippetId)){
            throw new \InvalidArgumentExceptoin('Invalid text snippet  ID provided.', $textSnippetId);
        }
         
        $expectedText = $this->textRepo->find($textSnippetId)->getContent();

        // calculate accuracy
        $accuracy = $this->accuracyCal->calculateAccuracy($incorrectChar, $expectedText);
        
        $wpm = $this->wpmCal->calculateWPM($inputText); 
        
        // print_r($wpm);
        $testData = new TestResult();
        $testData->setInputText($inputText);
        // print_r($duration);
        $testData->setDuration($duration);  
        $testData->setAccuracy($accuracy);  
        // print_r(" --- --- ");
        // print_r($wpm);
        $testData->setWpm($wpm); 
        $testData->setCreatedAt(new DatePoint(timezone: new DateTimeZone("Asia/Seoul")));
        $testData->setTextSnippet($textSnipped);

        $this->entityManager->persist($testData);
        $this->entityManager->flush(); 

        return $testData;

    }




}