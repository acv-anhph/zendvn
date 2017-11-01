<?php

class UserController extends Controller {

    public function __construct($arrParam) {
        parent::__construct($arrParam);
        $this->_templateObj->setFolderTemplate('default/main/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }

    public function registerAction() {
        $this->_view->_title = 'Register';
        if (isset($this->_arrParam['form']['submit'])) {
            URL::checkRefreshPage($this->_arrParam['form']['token'], 'default', 'user', 'register');

            $queryUserName = "SELECT `id` FROM `" . USER_TABLE . "` WHERE `username` = '" . $this->_arrParam['form']['username'] . "'";
            $queryEmail    = "SELECT `id` FROM `" . USER_TABLE . "` WHERE `email` = '" . $this->_arrParam['form']['email'] . "'";
            $validate      = new Validate($this->_arrParam['form']);
            $validate->addRule('username', 'string-notExistRecord', array(
                'min' => 3,
                'max' => 255,
                'database' => $this->_model,
                'query' => $queryUserName
            ), true)->addRule('email', 'email-notExistRecord', array(
                    'database' => $this->_model,
                    'query' => $queryEmail
                ), true)->addRule('password', 'password', array('action' => 'add'), true)->addRule('fullname', 'string', array(
                    'min' => 3,
                    'max' => 255
                ));
            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();
            if ($validate->isValid() == false) {
                $this->_view->errors = $validate->showErrors();
            } else {
                $id = $this->_model->saveItem($this->_arrParam, array('task' => 'user-register'));
                URL::redirect('default', 'index', 'notice', array('type' => 'register-success'));
            }
        }
        $this->_view->render('user/register');
    }

    public function indexAction() {
        $this->_view->render('user/index');
    }

    public function logoutAction() {
        Session::delete('user');
        URL::redirect('default', 'user', 'login');
    }
}