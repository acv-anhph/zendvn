<?php

class BookModel extends Model {
    private $_columns = array(
        'id',
        'name',
        'description',
        'price',
        'sale_off',
        'picture',
        'created',
        'created_by',
        'modified',
        'modified_by',
        'status',
        'ordering',
        'category_id'
    );

    private $_user;

    public function __construct() {
        parent::__construct();
        $this->setTable(BOOK_TABLE);
        $this->_user = (Session::get('user')['info']) ? Session::get('user')['info'] : array();
    }

    public function countItem($arrParam, $option = null){

        $query[]	= "SELECT COUNT(`id`) AS `total`";
        $query[]	= "FROM `$this->table`";
        $query[]	= "WHERE `id` > 0";

        // FILTER : KEYWORD
        if(!empty($arrParam['filter_search'])){
            $keyword	= '"%' . $arrParam['filter_search'] . '%"';
            $query[]	= "AND (`name` LIKE $keyword)";
        }

        // FILTER : STATUS
        if(isset($arrParam['filter_state']) && $arrParam['filter_state'] != 'default'){
            $query[]	= "AND `status` = '" . $arrParam['filter_state']. "'";
        }

        // FILTER : SPECIAL
        if(isset($arrParam['filter_special']) && $arrParam['filter_special'] != 'default'){
            $query[]	= "AND `special` = '" . $arrParam['filter_special'] . "'";
        }

        // FILTER : CATEGORY ID
        if(isset($arrParam['filter_category_id']) && $arrParam['filter_category_id'] != 'default'){
            $query[]	= "AND `category_id` = '" . $arrParam['filter_category_id'] . "'";
        }

        $query		= implode(" ", $query);
        $result		= $this->fetchRow($query);
        return $result['total'];
    }

    public function listItem($arrParam, $option = null) {
        $query[] = "SELECT `b`.`id`, `b`.`special`, `b`.`name`, `b`.`picture`, `b`.`price`, `b`.`sale_off`, `b`.`status`, `b`.`ordering`, `b`.`created`, `b`.`created_by`, `b`.`modified`, `b`.`modified_by`, `c`.`name` AS `category_name`";
        $query[] = "FROM `$this->table` AS `b` LEFT JOIN `" . CATEGORY_TABLE . "` AS `c` ON `b`.`category_id` = `c`.`id`";
        $query[] = "WHERE `b`.`id` > 0";

        // FILTER : KEYWORD
        if (!empty($arrParam['filter_search'])) {
            $keyword = '"%' . $arrParam['filter_search'] . '%"';
            $query[] = "AND (`b`.`name` LIKE $keyword)";
        }

        // FILTER : STATUS
        if (isset($arrParam['filter_state']) && $arrParam['filter_state'] != 'default') {
            $query[] = "AND `b`.`status` = '" . $arrParam['filter_state'] . "'";
        }

        // FILTER : SPECIAL
        if (isset($arrParam['filter_special']) && $arrParam['filter_special'] != 'default') {
            $query[] = "AND `b`.`special` = '" . $arrParam['filter_special'] . "'";
        }

        // FILTER : CATEGORY ID
        if (isset($arrParam['filter_category_id']) && $arrParam['filter_category_id'] != 'default') {
            $query[] = "AND `b`.`category_id` = '" . $arrParam['filter_category_id'] . "'";
        }

        // SORT
        if (!empty($arrParam['filter-column']) && !empty($arrParam['filter-column-dir'])) {
            $column    = $arrParam['filter-column'];
            $columnDir = $arrParam['filter-column-dir'];
            $query[]   = "ORDER BY `b`.`$column` $columnDir";
        } else {
            $query[] = "ORDER BY `b`.`id` DESC";
        }

        // PAGINATION
        $pagination        = $arrParam['pagination'];
        $totalItemsPerPage = $pagination['totalItemsPerPage'];
        if ($totalItemsPerPage > 0) {
            $position = ($pagination['currentPage'] - 1) * $totalItemsPerPage;
            $query[]  = "LIMIT $position, $totalItemsPerPage";
        }

        $query  = implode(" ", $query);
        $result = $this->fetchAll($query);
        return $result;
    }

    public function changeStatus($param, $option = null) {
        if ($option['task'] == 'change-ajax-status') {
            $status = ($param['status'] == 0) ? 1 : 0;
            $id     = $param['id'];
            $query  = "UPDATE `$this->table` SET `status` = '$status' WHERE `id` = '$id'";
            $this->query($query);

            $result = array(
                'id' => $id,
                'status' => $status,
                'link' => URL::createLink('admin', 'user', 'ajaxStatus', array(
                    'id' => $id,
                    'status' => $status
                ))
            );

            return $result;
        }

        if ($option['task'] == 'change-ajax-special') {
            $special = ($param['special'] == 0) ? 1 : 0;
            $id     = $param['id'];
            $query  = "UPDATE `$this->table` SET `special` = '$special' WHERE `id` = '$id'";
            $this->query($query);

            $result = array(
                'id' => $id,
                'special' => $special,
                'link' => URL::createLink('admin', 'book', 'ajaxSpecial', array(
                    'id' => $id,
                    'status' => $special
                ))
            );

            return $result;
        }


        if ($option['task'] == 'change-status') {
            $ids    = 0;
            $status = $param['type'];
            if (!empty($param['cid'])) {
                $ids   = $this->createWhereDeleteSQL($param['cid']);
                $query = "UPDATE `$this->table` SET `status` = $status WHERE `id` IN ($ids)";
                $this->query($query);
                Session::set('message', array(
                    'class' => 'success',
                    'content' => 'Có ' . $this->affectedRows() . ' phần tử được thay đổi trạng thái!'
                ));
            } else {
                Session::set('message', array(
                    'class' => 'error',
                    'content' => 'Vui lòng chọn vào phần tử muỗn thay đổi trạng thái!'
                ));
            }

        }
    }

    public function changeOrdering($arrParam, $option = null) {
        if ($option == null) {
            if (!empty($arrParam['order'])) {
                $i = 0;
                foreach ($arrParam['order'] as $id => $order) {
                    $query = "UPDATE `$this->table` SET `ordering` = '" . $order . "' WHERE `id` = '" . $id . "'";
                    $this->query($query);
                    if ($this->affectedRows() > 0) {
                        $i++;
                    }
                }
                if ($i > 0) {
                    Session::set('message', array(
                        'class' => 'success',
                        'content' => 'Có ' . $i . ' phần tử được thay đổi ordering!'
                    ));
                } else {
                    Session::set('message', array(
                        'class' => 'error',
                        'content' => 'Không có phần tử nào được thay đổi ordering!'
                    ));
                }

            }
        }
    }

    public function deleteItem($arrParam, $option = null) {
        if ($option == null) {
            if (!empty($arrParam['cid'])) {
                $ids   = $this->createWhereDeleteSQL($arrParam['cid']);
                $query = "DELETE FROM `$this->table` WHERE `id` IN ($ids)";
                $this->query($query);
                Session::set('message', array(
                    'class' => 'success',
                    'content' => 'Có ' . $this->affectedRows() . ' phần tử được xóa!'
                ));
            } else {
                Session::set('message', array(
                    'class' => 'error',
                    'content' => 'Vui lòng chọn vào phần tử muỗn xóa!'
                ));
            }
        }
    }

    public function saveItem($arrParam, $option = null){
        require_once LIBRARY_EXT_PATH . 'Upload.php';
        $uploadObj	= new Upload();

        if($option['task'] == 'add'){
            $arrParam['form']['picture']	= $uploadObj->uploadFile($arrParam['form']['picture'], 'book', 98, 150);
            $arrParam['form']['created']	= date('Y-m-d', time());
            $arrParam['form']['created_by']	= $this->_user['username'];

            $data	= array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->insert($data);
            Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
            return $this->lastID();
        }
        if($option['task'] == 'edit'){
            if($arrParam['form']['picture']['name']==null){
                unset($arrParam['form']['picture']);
            }else{
                $uploadObj->removeFile('book', $arrParam['form']['picture_hidden']);
                $uploadObj->removeFile('book', '98x150-' .  $arrParam['form']['picture_hidden']);

                $arrParam['form']['picture']	= $uploadObj->uploadFile($arrParam['form']['picture'], 'book', 98, 150);
            }

            $arrParam['form']['modified']	= date('Y-m-d', time());
            $arrParam['form']['modified_by']= $this->_userInfo['username'];

            $data	= array_intersect_key($arrParam['form'], array_flip($this->_columns));

            $this->update($data, array(array('id', $arrParam['form']['id'])));
            Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
            return $arrParam['form']['id'];
        }
    }

    public function infoItem($arrParam, $option = null){
        if($option == null){
            $query[]	= "SELECT `id`, `description`, `picture`,`name`, `price`, `special`,`sale_off`,`category_id`, `status`, `ordering`";
            $query[]	= "FROM `$this->table`";
            $query[]	= "WHERE `id` = '" . $arrParam['id'] . "'";
            $query		= implode(" ", $query);
            $result		= $this->fetchRow($query);
            return $result;
        }

        return '';
    }

    public function itemInSelectbox($arrParam, $option = null) {
        $result = array();

        if ($option == null) {
            $query             = "SELECT `id`, `name` FROM `" . CATEGORY_TABLE . "`";
            $result            = $this->fetchPairs($query);
            $result['default'] = "- Select Category -";
            ksort($result);
        }

        return $result;
    }
}