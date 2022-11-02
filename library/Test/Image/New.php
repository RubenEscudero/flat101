<?php

require_once 'Test/Image.php';

/**
 * Jpeg
 */
class Test_Image_New extends Test_Image {
    
    /*--------------------------------------------------------------------------
     * Constructor
     *-------------------------------------------------------------------------*/
    
    public function __construct($width, $height) { 
        $this->_type = self::TYPE_PNG;
        $this->_image = @imagecreatetruecolor($width, $height);
        
        if($this->_image === false) {
            throw new Test_Exception("Incorrect size");
        }
        
        imagefill($this->_image, 0, 0, 'White');
    }
    
    /*--------------------------------------------------------------------------
     * Manipulate
     *-------------------------------------------------------------------------*/
    
    public function save($file = null, $quality = 3, $params = null) { 
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