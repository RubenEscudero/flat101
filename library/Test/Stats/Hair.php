<?php

/**
 * Hair
 */
class Test_Stats_Hair extends Test_Stats_Abstract {

    private function getHairLong() {
        
        // El pelo crece a una velocidad media de 1.25 cm / mes.
        $hairLong = $this->getBirthdaySeconds() * 1.25 / (31 * 24 * 60 * 60);

        return number_format($hairLong / 100, 2);
    }

    public function getImage() {
        return "./var/jirafa.jpeg";
    }

    public function getText() {

        $hairLong = $this->getHairLong();
        $giraffaLong = 4.8;

        $comparation = "";

        if ($hairLong <= 2) {
            $comparation = "Ni se compara a la altura de una jirafa.";
        } else if ($hairLong > 2 && $hairLong < 2.8) {
            $comparation = "¡La mitad que la altura de una jirafa!";
        } else if ($hairLong >= 2.8 && $hairLong < 4.4) {
            $comparation = "¡Casi como la altura de una jirafa!";
        } else if ($hairLong >= 4.4 && $hairLong <= 5) {
            $comparation = "¡Tanto como la altura de una jirafa!";
        } else {
            $comparation = "¡Mas que la altura de una jirafa!";
        }

        return "Tu pelo ha crecido hasta el momento una media de " . $this->getHairLong() . " metros. $comparation";
    }

}