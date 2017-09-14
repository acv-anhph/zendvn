<?php

class Controller {
    
    protected $_view;
    protected $_model;
    protected $_arrParam;
    
    public function loadModel($moduleName = null, $modelName = null) {
        $modelName = ucfirst($modelName) . 'Model';
        $filePath = APPLICATION_PATH . $moduleName . DS . 'models' . DS . $modelName . '.php';
        if (file_exists($filePath)) {
            require_once($filePath);
            $this->_model = new $modelName();
        }
    }
    
    public function setView($moduleName) {
        $this->_view = new View($moduleName);
    }
    
    public function setParams($arrParams) {
        $this->_arrParam = $arrParams;
    }

}