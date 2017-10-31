<?php

class UserModel extends Model {
    private $_columns = array('id', 'username', 'email', 'fullname', 'password', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering', 'group_id', 'register_ip', 'register_date');


    public function __construct() {
        parent::__construct();
        $this->setTable(USER_TABLE);
    }

    public function saveItem($arrParam, $option = null) {
        if ($option['task'] == 'user-register') {
            $arrParam['form']['register_date'] = date('Y-m-d H:m:s', time());
            $arrParam['form']['password'] = md5($arrParam['form']['password']);
            $arrParam['form']['register_ip'] = $_SERVER['REMOTE_ADDR'];
            $arrParam['form']['status'] = 0;
            $data = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->insert($data);
            Session::set('message', array('class' => 'success', 'content' => 'Bạn đã đăng ký thành công!'));
            return $this->lastID();
        }

        if ($option['task'] == 'edit') {
            $arrParam['form']['modified'] = date('Y-m-d', time());
            $arrParam['form']['modified_by'] = 10;
            $data = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->update($data, array(array('id', $arrParam['form']['id'])));
//            Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
            return $arrParam['form']['id'];
        }

        return false;
    }
}