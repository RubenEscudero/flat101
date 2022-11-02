<?php

require_once 'Test/Image.php';

/**
 * Png
 */
class Test_Image_Png extends Test_Image {
    
    /*--------------------------------------------------------------------------
     * Constructor
     *-------------------------------------------------------------------------*/
    
    public function __construct($file) { 
        parent::__construct($file, self::TYPE_PNG);
    }
    
    /*--------------------------------------------------------------------------
     * Output
     *-------------------------------------------------------------------------*/
    
    public function save($file = null, $quality = 9, $params = null) { 
        
        $filters = null;
        
        if(is_array($params) && isset($params['filters'])) {
            $filters = $params['filters'];
        }
        
        $res = @imagepng($this->getImageResource(), $file, $quality, $filters);
        
        if($res === false) {
            throw new Test_Exception('Error saving image');
        }
    }
    
    public function sendToOutput($quality = 95) {
        header('Content-type: image/png');
        $this->save(null, $quality);
    }
}