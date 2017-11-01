<?php

class UserModel extends Model {
    private $_columns = array('id', 'username', 'email', 'fullname', 'password', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering', 'group_id', 'register_ip', 'register_date');


    public function __construct() {
        parent::__construct();
        $this->setTable(USER_TABLE);
    }

}