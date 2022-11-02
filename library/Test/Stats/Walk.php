<?php

/**
 * Walk
 */
class Test_Stats_Walk extends Test_Stats_Abstract {

    private function getRaceInfo() {
        $walkKm = ($this->getBirthdaySeconds() / 60 / 60 * 4);
        $runKm = ($this->getBirthdaySeconds() / 60 / 60 * 15);

        // 384400 km es la distancia media entre la tierra y la luna.
        array(
            'walk_total_km' => $walkKm,
            'run_total_km' => $runKm,
            'walk_moon' => $walkKm / (384.400 * 2),
            'run_moon' => $runKm / (384.400 * 2),
        );
    }

    public function getImage() {
        return "./var/moon.jpg";
    }

    public function getText() {
        $long = $this->getRaceInfo();
        return "Si te hubieses puesto a andar nada mas nacer, habrias caminado un total de " . number_format($long['walk_total_km'], 0) . " km, que es lo mismo que ir y volver de la luna casi " . ceil($long['walk_moon']) . " veces. Corriendo habrian sido " . number_format($long['run_total_km'], 0) . " km, un total de " . ceil($long['run_moon']) . " viajes de ida y vuelta a la luna.";
    }

}