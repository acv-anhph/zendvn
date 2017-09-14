<?php

class IndexController extends Controller {
    
    public function IndexAction() {
        $this->_model->IndexAction();
        $this->_view->data = array('phps', 'joomla');
        $this->_view->render('index/index');
	}
    
    public function AddAction() {
        $this->_view->render('index/add');
    }
}