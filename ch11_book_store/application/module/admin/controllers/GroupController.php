<?php

class GroupController extends Controller {
    
    public function __construct($arrParam) {

        parent::__construct($arrParam);
        $this->_templateObj->setFolderTemplate('admin/main/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }
    
    public function indexAction() {
		$this->_view->_title = 'User Manager: User Groups';
		$this->_view->groupList = $this->_model->listItems($this->_arrParam, null);
		$totalItem = $this->_model->countItem($this->_arrParam, null);
		$this->_view->pagination = new Pagination($totalItem, $this->_pagination);
        $this->_view->render('group/index');
	}
	
	public function formAction() {
		$this->_view->_title = 'User Manager: Add New Group';
		$this->_view->render('group/form');
	}
    
    public function ajaxStatusAction() {
        $result = $this->_model->changeStatus($this->_arrParam, $option = array('task' => 'change-ajax-status'));
        echo json_encode($result);
	}
    
    public function ajaxACPAction() {
        $result = $this->_model->changeStatus($this->_arrParam, $option = array('task' => 'change-ajax-group-acp'));
        echo json_encode($result);
    }
    
    public function statusAction() {
        $this->_model->changeStatus($this->_arrParam, $option = array('task' => 'change-status'));
        URL::redirect(URL::createLink('admin', 'group', 'index'));
    }
    
    public function deleteAction() {
        $this->_model->deleteItem($this->_arrParam);
        URL::redirect(URL::createLink('admin', 'group', 'index'));
    }
    
    public function orderingAction() {
        $this->_model->changeOrdering($this->_arrParam);
        URL::redirect(URL::createLink('admin', 'group', 'index'));
    }
}