<?php

/**
 * Size
 */
class Test_Geometry_Size {
    
    private $_width;
    private $_height;
    
    public function __construct($width, $height) {
        $this->_width = $width;
        $this->_height = $height;
    }
    
    public function getWidth() {
        return $this->_width;
    }
    
    public function getHeight() {
        return $this->_height;
    }
    
    public function __toString() {
        return sprintf("[%d,%d]", $this->getWidth(), $this->getHeight());
    }
}