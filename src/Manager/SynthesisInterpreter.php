<?php

namespace App\Manager;

/**
 * Class SynthesisInterpreter
 * @package App\Manager
 */
class SynthesisInterpreter extends MainInterpreter
{
    /**
     * @var SynthesisCalculator $synthesisCalculator
     */
    private $synthesisCalculator = null;

    /**
     * @var array $synthesisData
     */
    private $synthesisData = [];

    /**
     * Set all Interpretation Data from Synthesis
     */
    public function __construct()
    {
        parent::__construct();
        
        if (
            $this->checkArray($this->getPost(), "birthDate")
            && $this->checkArray($this->getPost(), "firstName")
            && $this->checkArray($this->getPost(), "lastName")
        ) {
            $this->synthesisCalculator = new SynthesisCalculator();

            $this->setPowerData();
            $this->setSpiritualData();
        }
    }

    /**
     * Return all Interpretation Data from Synthesis
     * @return array
     */
    public function getSynthesisData()
    {
        return $this->synthesisData;
    }

     // *********************************************** \\
    // ******************** SETTERS ******************** \\

    /**
     * Set Interpretation of Power Numbers to Synthesis Data
     */
    private function setPowerData()
    {
        $powerNumbers = $this->synthesisCalculator->getSynthesisNumbers("power");

        $this->synthesisData["powerDigit"] = $this->getDigitData(
            $powerNumbers, 
            "power",
            "Nombre de Pouvoir"
        );

        $this->synthesisData["powerNumber"] = $this->getDoubleNumber(
            $powerNumbers[1], 
            "power"
        );
    }

    /**
     * Set Interpretation of Spiritual Numbers to Synthesis Data
     */
    private function setSpiritualData()
    {
        $spiritualNumbers = $this->synthesisCalculator->getSynthesisNumbers("spiritual");

        $this->synthesisData["spiritualDigit"] = $this->getDigitData(
            $spiritualNumbers, 
            "spiritual",
            "Nombre Spirituel"
        );

        $this->synthesisData["spiritualNumber"] = $this->getQuadrupleNumber(
            $spiritualNumbers[1], 
            "spiritual"
        );
    }
}
