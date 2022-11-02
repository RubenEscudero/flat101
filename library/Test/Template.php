<?php

/**
 * Template
 */
class Test_Template {
    
    /*--------------------------------------------------------------------------
     * Variables
     *-------------------------------------------------------------------------*/
    
    private $_variables = array();
    private $_body;
    
    /*--------------------------------------------------------------------------
     * Constructor
     *-------------------------------------------------------------------------*/
    
    public function __construct($file) {
        $this->load($file);
    }
    
    /* --------------------------------------------------------------------------
     * Variables
     * ------------------------------------------------------------------------- */

    public function addVariables($array) {
        if (!is_array($array)) {
            throw new Test_Exception('El parametro no es un array');
        }

        foreach ($array as $name => $value) {
            $this->addVariable($name, $value);
        }
    }

    public function addVariable($name, $value) {
        $this->_variables[$name] = $value;
    }

    public function removeVariable($name) {
        if(isset($this->_variables[$name])) {
            unset($this->_variables[$name]);
        }
    }

    /* --------------------------------------------------------------------------
     * IO
     * ------------------------------------------------------------------------- */

    public function load($file) {
        $this->_body = file_get_contents($file);
    }

    /* --------------------------------------------------------------------------
     * Magic
     * ------------------------------------------------------------------------- */

    public function __toString() {
        
        $tmp = $this->_body;
        
        foreach($this->_variables as $name => $value) {
            $tmp = str_replace('{' . $name . '}', $value, $tmp);
        }
        
        return $tmp;
    }

}
