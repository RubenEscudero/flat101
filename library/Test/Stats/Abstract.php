<?php

/**
 * Abstract
 */
abstract class Test_Stats_Abstract {
    
    private $_timestamp;
    
    public function __construct($birthTimeStamp) {
        $this->_timestamp = $birthTimeStamp;
    }
    
    public function getBirthday() {
        return $this->_timestamp;
    }
    
    // Segundos desde que naciste
    protected function getBirthdaySeconds() {
        return $this->getBirthday() - time();
    }
    
    abstract function getImage();
    abstract function getText();
    
    public function __toString() {
        return $this->getText();
    }
    
}