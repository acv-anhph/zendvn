<?php

class ErrorController extends Controller {
    
    public function __construct($param) {
        parent::__construct($param);
        $this->_templateObj->setFolderTemplate('default/main/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }
    
    public function indexAction() {
	    $this->_view->render('error/index');
	}
}