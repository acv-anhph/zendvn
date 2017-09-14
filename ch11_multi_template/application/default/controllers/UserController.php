<?php

class UserController extends Controller {

	public function IndexAction() {
        $this->_view->render('user/index');
	}
}