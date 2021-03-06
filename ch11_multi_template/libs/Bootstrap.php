<?php

class Bootstrap {
    private $_params;
    private $_controllerObj;
    
    public function init() {
        $this->setParams();
        
        $controllerName = ucfirst($this->_params['controller']) . 'Controller';
        $filePath = APPLICATION_PATH . $this->_params['module'] . DS . 'controllers' . DS . $controllerName . '.php';
        
        if (file_exists($filePath)) {
            $this->loadExistingController($controllerName, $filePath);
            $this->callMethod();
        } else {
            $this->loadDefaultController();
            $this->callMethod();
        }
    }
    
    private function setParams() {
        $this->_params 	= array_merge($_GET, $_POST);
        $this->_params['module'] 		= isset($this->_params['module']) ? $this->_params['module'] : DEFAULT_MODULE;
        $this->_params['controller'] 	= isset($this->_params['controller']) ? $this->_params['controller'] : DEFAULT_CONTROLLER;
        $this->_params['action'] 		= isset($this->_params['action']) ? $this->_params['action'] : DEFAULT_ACTION;
    }
    
    private function loadDefaultController() {
        $controllerName	= ucfirst(DEFAULT_CONTROLLER) . 'Controller';
        $defaultAction = DEFAULT_ACTION . 'Action';
        $filePath	= APPLICATION_PATH . DEFAULT_MODULE . DS . 'controllers' . DS . $controllerName . '.php';
        if (file_exists($filePath)) {
            require_once $filePath;
        
            $this->_controllerObj = new $controllerName(array('module' => DEFAULT_MODULE, 'controller' => DEFAULT_CONTROLLER));
        }
    }
    
    private function loadExistingController($controllerName, $path) {
        if (file_exists($path)) {
            require_once $path;
            
            $this->_controllerObj = new $controllerName($this->_params);
        }
    }
    
    private function callMethod() {
        $actionname = $this->_params['action'] . 'Action';
        if (method_exists($this->_controllerObj, $actionname)) {
            $this->_controllerObj->$actionname();
        } else {
            $this->_error();
        }
        
    }
    
    private function _error() {
        require_once APPLICATION_PATH . 'default' . DS . 'controllers' . DS . 'ErrorController' . '.php';
        $this->_controllerObj = new ErrorController(array('module' => DEFAULT_MODULE, 'controller' => 'error'));
        $this->_controllerObj->indexAction();
    }
}