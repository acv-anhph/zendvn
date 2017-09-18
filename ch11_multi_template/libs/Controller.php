<?php

class Controller {
    
    protected $_view;
    protected $_model;
    
    //GET POST
    protected $_arrParam;
    protected $_templateObj;
    
    public function __construct($arrParam) {
        $this->setModel($arrParam['module'], $arrParam['controller']);
        $this->setTemplate($this);
        $this->setView($arrParam['module']);
        $this->setParams($arrParam);
    }
    
    public function setModel($moduleName = null, $modelName = null) {
        $modelName = ucfirst($modelName) . 'Model';
        $filePath = APPLICATION_PATH . $moduleName . DS . 'models' . DS . $modelName . '.php';
        if (file_exists($filePath)) {
            require_once($filePath);
            $this->_model = new $modelName();
        }
    }
    
    public function getModel() {
        return $this->_model;
    }
    
    public function setView($moduleName) {
        $this->_view = new View($moduleName);
    }
    
    public function getView() {
        return $this->_view;
    }
    
    public function setParams($arrParams) {
        $this->_arrParam = $arrParams;
    }
    
    public function getArrParam() {
        return $this->_arrParam;
    }
    
    public function setTemplate() {
        $this->_templateObj = new Template($this);
    }
    
    public function getTemplateObj() {
        return $this->_templateObj;
    }
}