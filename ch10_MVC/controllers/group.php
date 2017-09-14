<?php

class Group extends Controller {
    public function __construct() {
        parent::__construct();
	    Auth::checkLogin();
	    $this->view->title = 'Group';
    }
    
    public function index() {
	    $this->view->records = $this->db->listItems();
	    $this->view->js		= array('group/js/group.js');
	    $this->view->css	= array('group/css/jquery-ui.min.css');
	    $this->view->render('group/index');
    }
	
	public function delete() {
    	if (!empty($_POST['id'])) {
		    $this->db->deteteGroup($_POST['id']);
	    }
	}
}