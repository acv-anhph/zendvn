<?php
    
    class Error extends Controller {
	    public function index() {
//            echo '<pre>';
//            print_r($this);
//            echo '</pre>';
            echo 'Action index cua controller Error';
            $message = 'This is an error';
            $this->view->msg = $message;
            $this->view->render('error/index');
        }
    }