<?php

class CategoryController extends Controller {
    
    public function __construct($arrParam) {

        parent::__construct($arrParam);
        $this->_templateObj->setFolderTemplate('admin/main/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }
    
    public function indexAction() {
		$this->_view->_title = 'Category Manager: List';
		$this->_view->categoryList = $this->_model->listItems($this->_arrParam, null);
		$totalItem = $this->_model->countItem($this->_arrParam, null);
		$this->_view->pagination = new Pagination($totalItem, $this->_pagination);
        $this->_view->render('category/index');
	}
	
	public function formAction() {
		$this->_view->_title = 'Category Manager: Add New Category';
        if (!empty($this->_arrParam['id'])) {
            $this->_view->_title = 'category Manager: Edit category';
            $this->_arrParam['form'] = $this->_model->infoItem($this->_arrParam);
        }

        if (isset($this->_arrParam['form']) && !empty($this->_arrParam['form']['token'])) {
            $this->_arrParam['form']['picture'] = !empty($_FILES['picture']) ? $_FILES['picture'] : array();
            $validate = new Validate($this->_arrParam['form']);
            $validate->addRule('name', 'string', array('min' => 3, 'max' => 255))
                     ->addRule('ordering', 'int', array('min' => 1, 'max' => 100))
                     ->addRule('status', 'status', array('deny' => array('default')))
                     ->addRule('picture', 'file', array('min' => 100, 'max' => 100000, 'extension' => array('jpg', 'png', 'gif')), false)
            ;
            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();
            if($validate->isValid() == false){
                $this->_view->errors = $validate->showErrors();
            }else{
                $task	= (isset($this->_arrParam['form']['id'])) ? 'edit' : 'add';
                $id	= $this->_model->saveItem($this->_arrParam, array('task' => $task));
                if($this->_arrParam['type'] == 'save-close') 	URL::redirect('admin', 'category', 'index');
                if($this->_arrParam['type'] == 'save-new') 		URL::redirect('admin', 'category', 'form');
                if($this->_arrParam['type'] == 'save') 			URL::redirect('admin', 'category', 'form', array('id' => $id));
            }
        }
        $this->_view->arrParam = $this->_arrParam;
		$this->_view->render('category/form');
	}
    
    public function ajaxStatusAction() {
        $result = $this->_model->changeStatus($this->_arrParam, $option = array('task' => 'change-ajax-status'));
        echo json_encode($result);
	}
    
    public function statusAction() {
        $this->_model->changeStatus($this->_arrParam, $option = array('task' => 'change-status'));
        URL::redirect('admin', 'category', 'index');
    }
    
    public function deleteAction() {
        $this->_model->deleteItem($this->_arrParam);
        URL::redirect('admin', 'category', 'index');
    }
    
    public function orderingAction() {
        $this->_model->changeOrdering($this->_arrParam);
        URL::redirect('admin', 'category', 'index');
    }
}