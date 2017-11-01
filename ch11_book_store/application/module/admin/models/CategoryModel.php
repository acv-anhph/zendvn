<?php

class CategoryModel extends Model {
    private $_columns = array('id', 'name', 'picture', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering');


    public function __construct() {
        parent::__construct();
        $this->setTable(CATEGORY_TABLE);
    }
    
    public function countItem($arrParam, $option) {
        $query = array();
        $query[] = "SELECT COUNT(id) ";
        $query[] = "FROM `$this->table` ";
        $query[]	= "WHERE `id` > 0";

        // Filter: keyword

        if (!empty($arrParam['filter_search'])) {
            $keyword = '"%' . $arrParam['filter_search'] . '%"';
            $query[] = "AND `name` LIKE $keyword ";
        }
        
        if (isset($arrParam['filter_state']) && $arrParam['filter_state'] != 'default') {
            $query[] = "AND `status` = '" . $arrParam['filter_state'] . "'";
        }
        
        $query = implode(' ', $query);
        $result = $this->fetchRow($query)['COUNT(id)'];
        
        return $result;
    }
    
    public function listItems($arrParam, $option) {
        $query = array();
        $query[] = "SELECT * ";
        $query[] = "FROM `$this->table` ";
        $query[]	= "WHERE `id` > 0";
        
        // Filter: keyword
        if (!empty($arrParam['filter_search'])) {
            $keyword = '"%' . $arrParam['filter_search'] . '%"';
            $query[] = "AND `name` LIKE $keyword ";
            $whereFlag = true;
        }
        
        if (isset($arrParam['filter_state']) && $arrParam['filter_state'] != 'default') {
            $query[] = "AND `status` = '" . $arrParam['filter_state'] . "'";
        }

        //Sort
        if (!empty($arrParam['filter-column']) && !empty($arrParam['filter-column-dir'])) {
            $column = $arrParam['filter-column'];
            $columnDir = $arrParam['filter-column-dir'];
            $query[] = "ORDER BY `$column` $columnDir";
        } else {
            $query[] = "ORDER BY `id` ASC";
        }
        
        // PAGINATION
        $pagination = $arrParam['pagination'];
        $totalItemsPerPage = $pagination['totalItemsPerPage'];
        if ($totalItemsPerPage > 0) {
            $position = ($pagination['currentPage'] - 1) * $totalItemsPerPage;
            $query[] = "LIMIT $position, $totalItemsPerPage";
        }
        
        
        $query = implode(' ', $query);
        $result = $this->fetchAll($query);
        
        return $result;
    }
    
    public function changeStatus($param, $option = null) {
        if ($option['task'] == 'change-ajax-status') {
            $status = ($param['status'] == 0) ? 1 : 0;
            $id = $param['id'];
            $query = "UPDATE `$this->table` SET `status` = '$status' WHERE `id` = '$id'";
            $this->query($query);
            
            $result = array(
                'id' => $id,
                'status' => $status,
                'link' => URL::createLink('admin', 'category', 'ajaxStatus', array('id' => $id, 'status' => $status))
            );
            Session::set('message', array('class' => 'success', 'content' => 'Phần tử đã được thay đổi trạng thái!'));
            return $result;
        }

        
        if ($option['task'] == 'change-status') {
            $ids = 0;
            $status = $param['type'];
            if (!empty($param['cid'])) {
                $ids = $this->createWhereDeleteSQL($param['cid']);
                $query = "UPDATE `$this->table` SET `status` = $status WHERE `id` IN ($ids)";
                $this->query($query);
                Session::set('message', array('class' => 'success', 'content' => 'Có ' . $this->affectedRows() . ' phần tử được thay đổi trạng thái!'));
            } else {
                Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn vào phần tử muỗn thay đổi trạng thái!'));
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
                    Session::set('message', array('class' => 'success', 'content' => 'Có ' . $i . ' phần tử được thay đổi ordering!'));
                } else {
                    Session::set('message', array('class' => 'error', 'content' => 'Không có phần tử nào được thay đổi ordering!'));
                }
                
            }
        }
    }
    
    public function deleteItem($arrParam, $option = null){
        if($option == null){
            if(!empty($arrParam['cid'])){
                $ids		= $this->createWhereDeleteSQL($arrParam['cid']);
                $query		= "DELETE FROM `$this->table` WHERE `id` IN ($ids)";
                $this->query($query);
                Session::set('message', array('class' => 'success', 'content' => 'Có ' . $this->affectedRows(). ' phần tử được xóa!'));
            }else{
                Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn vào phần tử muỗn xóa!'));
            }
        }
    }

    public function saveItem($arrParam, $option = null){
        if($option['task'] == 'add'){
            $arrParam['form']['created']	= date('Y-m-d', time());
            $arrParam['form']['created_by']	= 1;
            $data	= array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->insert($data);
            Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
            return $this->lastID();
        }
        if($option['task'] == 'edit'){
            $arrParam['form']['modified']	= date('Y-m-d', time());
            $arrParam['form']['modified_by']= 10;
            $data	= array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->update($data, array(array('id', $arrParam['form']['id'])));
            Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
            return $arrParam['form']['id'];
        }
    }

    public function infoItem($arrParam, $option = null){
        if($option == null){
            $query[]	= "SELECT `id`, `name`, `picture`, `status`, `ordering`";
            $query[]	= "FROM `$this->table`";
            $query[]	= "WHERE `id` = '" . $arrParam['id'] . "'";
            $query		= implode(" ", $query);
            $result		= $this->fetchRow($query);
            return $result;
        }
    }
}