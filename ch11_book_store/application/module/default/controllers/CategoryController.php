<?php

class CategoryController extends Controller {
    
    public function __construct($arrParam) {
        parent::__construct($arrParam);
        $this->_templateObj->setFolderTemplate('default/main/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }
    
    public function indexAction() {
        $this->_view->render('index/index');
	}

}