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
		$this->_view->_title = 'Group Manager: Add New Group';
        if (!empty($this->_arrParam['id'])) {
            $this->_view->_title = 'Group Manager: Edit Group';
            $this->_arrParam['form'] = $this->_model->infoItem($this->_arrParam);
        }

        if (isset($this->_arrParam['form']) && !empty($this->_arrParam['form']['token'])) {
            $validate = new Validate($this->_arrParam['form']);
            $validate->addRule('name', 'string', array('min' => 3, 'max' => 255))
                     ->addRule('ordering', 'int', array('min' => 1, 'max' => 100))
                     ->addRule('status', 'status', array('deny' => array('default')))
                     ->addRule('group_acp', 'status', array('deny' => array('default')));
            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();
            if($validate->isValid() == false){
                $this->_view->errors = $validate->showErrors();
            }else{
                $task	= (isset($this->_arrParam['form']['id'])) ? 'edit' : 'add';
                $id	= $this->_model->saveItem($this->_arrParam, array('task' => $task));
                if($this->_arrParam['type'] == 'save-close') 	URL::redirect('admin', 'group', 'index');
                if($this->_arrParam['type'] == 'save-new') 		URL::redirect('admin', 'group', 'form');
                if($this->_arrParam['type'] == 'save') 			URL::redirect('admin', 'group', 'form', array('id' => $id));
            }
        }
        $this->_view->arrParam = $this->_arrParam;
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
        URL::redirect('admin', 'group', 'index');
    }
    
    public function deleteAction() {
        $this->_model->deleteItem($this->_arrParam);
        URL::redirect('admin', 'group', 'index');
    }
    
    public function orderingAction() {
        $this->_model->changeOrdering($this->_arrParam);
        URL::redirect('admin', 'group', 'index');
    }
}