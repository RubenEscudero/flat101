<?php

/**
 * Abstract
 */
class Test_Application_Abstract {
    public static function InitSession() {
        throw new Test_Exception('Not implementend');
    }
    
    public function getSession() {
        return static::InitSession();
    }
}
