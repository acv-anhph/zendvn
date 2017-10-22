<?php

class IndexController extends Controller {
    
    public function __construct($arrParam) {
        parent::__construct($arrParam);
        $this->_templateObj->setFolderTemplate('admin/main/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }
    
    public function indexAction() {
        $this->_model->indexAction();
        $this->_view->data = array('phps', 'joomla');
        $this->_view->render('index/index');
	}
    
    public function addAction() {
        $this->_view->render('index/add');
    }
}