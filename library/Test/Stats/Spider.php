<?php

/**
 * Spider
 */
class Test_Stats_Spider extends Test_Stats_Abstract {

    private function getÑamInfo() {
        // Nos comemos una media de 10 arañas y 70 insectos a lo largo de una vida de 80 años.
        $spiders = ceil((10 / (80 * 365 * 24 * 60 * 60)) * $this->getBirthdaySeconds());
        $insects = ceil((70 / (80 * 365 * 24 * 60 * 60)) * $this->getBirthdaySeconds());

        return array(
            'spiders' => $spiders,
            'insects' => $insects,
        );
    }

    public function getImage() {
        
        $info = $this->getÑamInfo();
        
        $spiderImg = new Test_Image_Jpeg('./var/spider.jpg');
        $insectImg = new Test_Image_Jpeg('./var/insect.jpg');
        
        $objWidth = 50;
        $objHeight = 50;
        $columns = 10;
        
        $img = new Test_Image_New($objWidth * $columns, ceil(($info['spiders'] + $info['insects']) / $columns) * $objHeight);
        
        for($i=0; $i<$info['insects']+$info['spiders']; $i++) {
            
            $x = $i * $objWidth % ($objWidth * $columns);
            $y = floor($i/$columns) * $objHeight;
            
            $imgToCopy = $insectImg;
            
            if($i > $info['insects']) {
                $imgToCopy = $spiderImg;
            }
            
            $img->copyTo($imgToCopy, $x, $y, $objWidth, $objHeight);
        }
        
        $img->save('./var/insectandspiders.png');
        
        return "./var/insectandspiders.png";
    }

    public function getText() {

        $ñam = $this->getÑamInfo();
        return "Que no te de asco, pero mientras dormias te has comido una media de " . $ñam['insects'] . " insectos, entre ellos " . $ñam['spiders'] . " eran arañas.";
    }

}