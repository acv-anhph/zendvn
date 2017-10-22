<?php

class UserController extends Controller {
    
    public function __construct($arrParam) {
        parent::__construct($arrParam);
        $this->_templateObj->setFolderTemplate('default/main/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }
    
    public function loginAction() {
        $this->_view->setTitle('Login');

        $this->_view->render('user/login', true);
    }
    
    public function logoutAction() {
        $this->_view->setTitle('Logout');
        $this->_view->render('user/logout', true);
    }
}