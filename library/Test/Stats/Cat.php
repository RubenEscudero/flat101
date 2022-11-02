<?php

/**
 * Cat
 */
class Test_Stats_Cat extends Test_Stats_Abstract {

    private function getInfo() {
        $maxCatLifeSeconds = 18 * 365 * 24 * 60 * 60 * 60;
        $maxHumanLifeSeconds = 80 * 365 * 24 * 60 * 60 * 60;

        $catYearsProportion = $maxHumanLifeSeconds / $maxCatLifeSeconds;

        return array(
            'cat_years' => ceil($catYearsProportion * ($this->getBirthdaySeconds() / 60 / 60 / 24 / 365)),
        );
    }

    public function getImage() {
        return "./var/simons.jpg";
    }

    public function getText() {

        $info = $this->getInfo();
        return "Si ahora te convirtieses en un gato, el equivalente en edad seria un gato de " . $info['cat_years'] . " años.";
    }

}