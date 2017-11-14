<?php

class IndexController extends Controller {
    
    public function __construct($arrParam) {
        parent::__construct($arrParam);
        $this->_templateObj->setFolderTemplate('default/main/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }

    public function indexAction(){
        $this->_view->_title	= 'Book Store';

        $this->_view->specialBooks	= $this->_model->listItem($this->_arrParam, array('task' => 'books-special'));
        $this->_view->newBooks		= $this->_model->listItem($this->_arrParam, array('task' => 'books-new'));
        $this->_view->render('index/index');
    }

    public function noticeAction() {
        $this->_view->render('index/notice');
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
        $this->_view->render('index/register');
    }

    public function loginAction() {
        $userInfo = Session::get('user');
        if ($userInfo['login'] == true && ($userInfo['time'] + SESSSION_LOGIN > time())) {
            URL::redirect('default', 'index', 'index');
        }

        $this->_view->_title = 'Login';

        if (isset($this->_arrParam['form']['token']) && $this->_arrParam['form']['token'] > 0) {
            $validate	= new Validate($this->_arrParam['form']);
            $username	= $this->_arrParam['form']['username'];
            $password	= md5($this->_arrParam['form']['password']);
            $query		= "SELECT `id` FROM `user` WHERE `username` = '$username' AND `password` = '$password'";
            $validate->addRule('username', 'existRecord', array('database' => $this->_model, 'query' => $query));
            $validate->run();

            if($validate->isValid()==true){
                $infoUser		= $this->_model->infoItem($this->_arrParam);
                $arraySession	= array(
                    'login'		=> true,
                    'info'		=> $infoUser,
                    'time'		=> time(),
                    'group_acp'	=> $infoUser['group_acp']
                );
                Session::set('user', $arraySession);
                URL::redirect('default', 'index', 'index');
            }else{
                $this->_view->errors	= $validate->showErrors();
            }
        }
        $this->_view->render('index/login');
    }

}