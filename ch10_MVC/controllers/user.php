<?php

class User extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function login() {
    
        if (Session::get('loggedIn') == true) {
            $this->redirect('group', 'index');
        }
        
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $source = array('username' => $username);
            $validate = new Validate($source);
            $query = "SELECT `id` FROM `manage_user` WHERE `username` = '$username' AND `password` = '$password'";
            $validate->addRule('username', 'existRecord', array('database' => $this->db, 'query' => $query));
            $validate->run();
            if ($validate->isValid() == true) {
                Session::set('loggedIn', true);
                $this->redirect('group','index');
            } else {
                $this->view->errors = $validate->showErrors();
            }
        }
        $this->view->render('user/login');
    }
    
    public function logout() {
        Session::destroy();
        $this->view->render('user/logout');
    }
}