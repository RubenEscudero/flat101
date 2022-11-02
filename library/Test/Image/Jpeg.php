<?php

require_once 'Test/Image.php';

/**
 * Jpeg
 */
class Test_Image_Jpeg extends Test_Image {
    
    /*--------------------------------------------------------------------------
     * Constructor
     *-------------------------------------------------------------------------*/
    
    public function __construct($file) { 
        parent::__construct($file, self::TYPE_JPEG);
    }
    
    /*--------------------------------------------------------------------------
     * Manipulate
     *-------------------------------------------------------------------------*/
    
    public function save($file = null, $quality = 95, $params = null) { 
        $res = @imagejpeg($this->getImageResource(), $file, $quality);
        
        if($res === false) {
            throw new Test_Exception('Error generating the image');
        }
    }
    
    public function sendToOutput($quality = 95) {
        header('Content-type: image/jpg');
        $this->save(null, $quality);
    }
}