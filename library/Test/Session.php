<?php

/**
 * Description of Session
 */
class Test_Sessión {
    
    /*--------------------------------------------------------------------------
     * Constructor
     *------------------------------------------------------------------------*/
    
    private static $_initialized;
    
    public static function init() {
        if(!self::$_initialized) {
            self::$_initialized = true;
            session_start();
        }
    }
    
    /*--------------------------------------------------------------------------
     * Variables
     *------------------------------------------------------------------------*/
    
    public function remove($var) {
        if(isset($_SESSION[$var])) {
            unset($_SESSION[$var]);
        }
    }
    
    public function get($key, $default = null) {
        self::init();
        
        if(isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return $default;
    }
    
    public function set($key, $value) {
        self::init();
        
        $_SESSION[$key] = $value;
    }
}