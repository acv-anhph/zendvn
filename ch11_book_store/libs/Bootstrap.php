<?php

class Bootstrap {
    private $_params;
    private $_controllerObj;

    public function init() {
        $this->setParams();

        $controllerName = ucfirst($this->_params['controller']) . 'Controller';
        $filePath       = MODULE_PATH . $this->_params['module'] . DS . 'controllers' . DS . $controllerName . '.php';

        if (file_exists($filePath)) {
            $this->loadExistingController($controllerName, $filePath);
            $this->callMethod();
        } else {
            $this->loadDefaultController();
            $this->callMethod();
        }
    }

    private function setParams() {
        $this->_params               = array_merge($_GET, $_POST);
        $this->_params['module']     = isset($this->_params['module']) ? $this->_params['module'] : DEFAULT_MODULE;
        $this->_params['controller'] = isset($this->_params['controller']) ? $this->_params['controller'] : DEFAULT_CONTROLLER;
        $this->_params['action']     = isset($this->_params['action']) ? $this->_params['action'] : DEFAULT_ACTION;
    }

    private function loadDefaultController() {
        $controllerName = ucfirst(DEFAULT_CONTROLLER) . 'Controller';
        $defaultAction  = DEFAULT_ACTION . 'Action';
        $filePath       = MODULE_PATH . DEFAULT_MODULE . DS . 'controllers' . DS . $controllerName . '.php';
        if (file_exists($filePath)) {
            require_once $filePath;

            $this->_controllerObj = new $controllerName(array(
                'module' => DEFAULT_MODULE,
                'controller' => DEFAULT_CONTROLLER
            ));
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
            $module     = $this->_params['module'];
            $controller = $this->_params['controller'];
            $action     = $this->_params['action'];
            $user       = Session::get('user');
            $logged = $user['login'] == true && ($user['time'] + SESSSION_LOGIN > time());
            $publicPageLogin = ($controller == 'user') && ($action == 'login');

            if ($module == 'admin') {
                if ($logged) {
                    if ($user['group_acp'] == 1) {
                        $this->_controllerObj->$actionname();
                    } else {
                        URL::redirect('default', 'index', 'notice', array('type' => 'not-permission'));
                    }
                } else {
                    Session::delete('user');
                    $filePath       = MODULE_PATH . $this->_params['module'] . DS . 'controllers' . DS . 'IndexController.php';
                    if (file_exists($filePath)) {
                        require_once $filePath;
                        $indexController = new IndexController($this->_params);
                        $indexController->loginAction();
                    }
                }
            } else {
                if ($logged) {
                    $this->_controllerObj->$actionname();
                } else {
                    Session::delete('user');
                    $filePath       = MODULE_PATH . $this->_params['module'] . DS . 'controllers' . DS . 'IndexController.php';
                    if (file_exists($filePath)) {
                        require_once $filePath;
                        $indexController = new IndexController($this->_params);
                        $indexController->loginAction();
                    }
                }
            }
        } else {
            $this->_error();
        }

    }

    private function _error() {
        require_once MODULE_PATH . 'default' . DS . 'controllers' . DS . 'ErrorController' . '.php';
        $this->_controllerObj = new ErrorController(array(
            'module' => DEFAULT_MODULE,
            'controller' => 'error'
        ));
        $this->_controllerObj->indexAction();
    }
}