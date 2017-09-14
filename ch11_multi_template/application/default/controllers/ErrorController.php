<?php

class ErrorController extends Controller {

	public function IndexAction() {
	    $this->_view->render('error/index');
	}
}