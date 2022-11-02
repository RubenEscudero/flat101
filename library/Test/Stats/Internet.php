<?php

/**
 * Internet
 */
class Test_Stats_Internet {

    private function getInfo() {

        // Desde que naciste o desde junio del 98, que se lanzó la primera tarifa plana de internet.
        $startToCount = min($this->getBirthdaySeconds(), time() - mktime(0, 0, 0, 6, 1, 1998));
        $internetTime = $startToCount * (8 / 24 / 60 / 60);

        return array(
            'total_days' => round($internetTime / 24),
            'total_years' => round($internetTime / 24 / 365),
            'percent' => number_format(($internetTime * 60 * 60) / $this->getBirthdaySeconds() * 100, 1),
        );
    }

    public function getImage() {
        return "./var/internet.jpg";
    }

    public function getText() {

        $info = $this->getInfo();

        return "Te has pasado " . $info['total_years'] . " años de tu vida navegando por Internet, eso es el " . $info['percent'] . "%.";
    }

}