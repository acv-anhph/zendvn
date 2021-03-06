<?php

class UserController extends Controller {
    
    public function __construct($arrParam) {
        parent::__construct($arrParam);
        $this->_templateObj->setFolderTemplate('admin/main/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }
    
    public function loginAction() {
        $this->_view->setTitle('Login');
        $this->_view->appendCSS(array('user/css/abc.css'));
        $this->_view->appendJS(array('user/js/abc.js'));
        $this->_view->render('user/login', true);
    }
    
    public function logoutAction() {
        $this->_view->setTitle('Logout');
        $this->_view->render('user/logout', true);
    }
}