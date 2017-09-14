<?php

class View {
    private $_moduleName;
    
    public function __construct($moduleName) {
        $this->_moduleName = $moduleName;
    }
    
    public function render($fileInclude, $full = true) {
        $filePath = APPLICATION_PATH . $this->_moduleName . DS . 'views' . DS . $fileInclude . '.php';
        if (file_exists($filePath)) {
            require_once $filePath;
        }
    }
}