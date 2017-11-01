<?php

class IndexModel extends Model {
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

    public function infoItem($arrParam, $option = null){
        if($option == null) {
            $username	= $arrParam['form']['username'];
            $password	= md5($arrParam['form']['password']);
            $query[]	= "SELECT `u`.`id`, `u`.`fullname`, `u`.`email`, `u`.`username`, `u`.`group_id`, `g`.`group_acp`";
            $query[]	= "FROM `user` AS `u` LEFT JOIN `group` AS g ON `u`.`group_id` = `g`.`id`";
            $query[]	= "WHERE `username` = '$username' AND `password` = '$password'";

            $query		= implode(" ", $query);
            $result		= $this->fetchRow($query);

            /*if($result['group_acp'] == 1){
                $strPrivilegeID = '';
                $arrPrivilege	= explode(',', $result['privilege_id']);
                foreach($arrPrivilege as $privilegeID) $strPrivilegeID	.= "'$privilegeID', ";

                $queryP[]	= "SELECT `id`, CONCAT(`module`, '-', `controller`, '-',`action`) AS `name`";
                $queryP[]	= "FROM `".TBL_PRIVELEGE."` AS p";
                $queryP[]	= "WHERE id IN ($strPrivilegeID'0')";

                $queryP		= implode(" ", $queryP);
                $result['privilege']	= $this->fetchPairs($queryP);
            }*/


            return $result;
        }
    }
}