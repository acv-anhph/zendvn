<?php

class UserController extends Controller {

    public function __construct($arrParam) {

        parent::__construct($arrParam);
        $this->_templateObj->setFolderTemplate('admin/main/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }

    public function indexAction() {
        $this->_view->_title = 'User Manager: User List';
        $totalItem = $this->_model->countItem($this->_arrParam, null);
        $this->setPagination(array('totalItemsPerPage' => 5, 'pageRange' => 3));
        $this->_view->userList = $this->_model->listItems($this->_arrParam, null);
        $this->_view->pagination = new Pagination($totalItem, $this->_pagination);
        $this->_view->selectbox = $this->_model->itemInSelectbox($this->_arrParam, null);
        $this->_view->render('user/index');
    }

    public function formAction() {
        $this->_view->_title = 'User Manager: Add New User';
        $this->_view->selectbox = $this->_model->itemInSelectbox($this->_arrParam, null);

        if (!empty($this->_arrParam['id'])) {
            $this->_view->_title = 'User Manager: Edit User';
            $this->_arrParam['form'] = $this->_model->infoItem($this->_arrParam);
        }

        if (isset($this->_arrParam['form']['token'])) {
            $validate = new Validate($this->_arrParam['form']);
            $validate->addRule('username', 'string', array('min' => 3, 'max' => 255))
                     ->addRule('email', 'email')
                     ->addRule('password', 'password', array('action' => 'add'))
                     ->addRule('ordering', 'int', array('min' => 1, 'max' => 100), false)
                     ->addRule('status', 'status', array('deny' => array('default')))
                     ->addRule('group_id', 'status', array('deny' => array('default')));
            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();
            if ($validate->isValid() == false) {
                $this->_view->errors = $validate->showErrors();
            } else {
                $task = (isset($this->_arrParam['form']['id'])) ? 'edit' : 'add';
                $id = $this->_model->saveItem($this->_arrParam, array('task' => $task));
                if ($this->_arrParam['type'] == 'save-close') {
                    URL::redirect('admin', 'user', 'index');
                }
                if ($this->_arrParam['type'] == 'save-new') {
                    URL::redirect('admin', 'user', 'form');
                }
                if ($this->_arrParam['type'] == 'save') {
                    URL::redirect('admin', 'user', 'form', array('id' => $id));
                }
            }
        }
        $this->_view->arrParam = $this->_arrParam;
        $this->_view->render('user/form');
    }

    public function ajaxStatusAction() {
        $result = $this->_model->changeStatus($this->_arrParam, $option = array('task' => 'change-ajax-status'));
        echo json_encode($result);
    }


    public function statusAction() {
        $this->_model->changeStatus($this->_arrParam, $option = array('task' => 'change-status'));
        URL::redirect('admin', 'user', 'index');
    }

    public function deleteAction() {
        $this->_model->deleteItem($this->_arrParam);
        URL::redirect('admin', 'user', 'index');
    }

    public function orderingAction() {
        $this->_model->changeOrdering($this->_arrParam);
        URL::redirect('admin', 'user', 'index');
    }
}