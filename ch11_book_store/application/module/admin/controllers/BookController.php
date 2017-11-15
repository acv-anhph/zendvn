<?php

class BookController extends Controller {

    public function __construct($arrParam) {

        parent::__construct($arrParam);
        $this->_templateObj->setFolderTemplate('admin/main/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }

    public function indexAction() {
        $this->_view->_title = 'Book Manager: book List';
        $totalItem = $this->_model->countItem($this->_arrParam, null);
        $this->setPagination(array('totalItemsPerPage' => 5, 'pageRange' => 3));
        $this->_view->Items = $this->_model->listItem($this->_arrParam, null);
        $this->_view->pagination = new Pagination($totalItem, $this->_pagination);
        $this->_view->selectbox = $this->_model->itemInSelectbox($this->_arrParam, null);
        $this->_view->render('book/index');
    }

    public function formAction() {
        $this->_view->_title = 'Book Manager: Add New Book';

        $this->_view->category = $this->_model->itemInSelectbox($this->_arrParam, null);

        $this->_view->selectbox = $this->_model->itemInSelectbox($this->_arrParam, null);


        if (!empty($this->_arrParam['id'])) {
            $this->_view->_title = 'book Manager: Edit book';
            $this->_arrParam['form'] = $this->_model->infoItem($this->_arrParam);
        }

        if (isset($this->_arrParam['form']['token'])) {

            $this->_arrParam['form']['picture'] = !empty($_FILES['picture']) ? $_FILES['picture'] : array();

            $validate = new Validate($this->_arrParam['form']);
            $validate->addRule('name', 'string', array('min' => 1, 'max' => 255))
                    ->addRule('picture', 'file', array('min' => 100, 'max' => 1000000, 'extension' => array('jpg', 'png')))
                    ->addRule('ordering', 'int', array('min' => 1, 'max' => 100))
                    ->addRule('status', 'status', array('deny' => array('default')))
                    ->addRule('special', 'status', array('deny' => array('default')))
                    ->addRule('category_id', 'status', array('deny' => array('default')))
                    ->addRule('price', 'int', array('min' => 1000, 'max' => '1000000'))
                    ->addRule('sale_off', 'int', array('min' => 0, 'max' => '100'));

            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();
            if ($validate->isValid() == false) {
                $this->_view->errors = $validate->showErrors();
            } else {
                $task = (isset($this->_arrParam['form']['id'])) ? 'edit' : 'add';
                $id = $this->_model->saveItem($this->_arrParam, array('task' => $task));
                if ($this->_arrParam['type'] == 'save-close') {
                    URL::redirect('admin', 'book', 'index');
                }
                if ($this->_arrParam['type'] == 'save-new') {
                    URL::redirect('admin', 'book', 'form');
                }
                if ($this->_arrParam['type'] == 'save') {
                    URL::redirect('admin', 'book', 'form', array('id' => $id));
                }
            }
        }
        $this->_view->arrParam = $this->_arrParam;
        $this->_view->render('book/form');
    }

    public function ajaxStatusAction() {
        $result = $this->_model->changeStatus($this->_arrParam, $option = array('task' => 'change-ajax-status'));
        echo json_encode($result);
    }

    public function ajaxSpecialAction() {
        $result = $this->_model->changeStatus($this->_arrParam, $option = array('task' => 'change-ajax-special'));
        echo json_encode($result);
    }

    public function statusAction() {
        $this->_model->changeStatus($this->_arrParam, $option = array('task' => 'change-status'));
        URL::redirect('admin', 'book', 'index');
    }

    public function deleteAction() {
        $this->_model->deleteItem($this->_arrParam);
        URL::redirect('admin', 'book', 'index');
    }

    public function orderingAction() {
        $this->_model->changeOrdering($this->_arrParam);
        URL::redirect('admin', 'book', 'index');
    }
}