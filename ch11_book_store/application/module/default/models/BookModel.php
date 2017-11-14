<?php
class BookModel extends Model{

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

    public function __construct(){
        parent::__construct();

        $this->setTable(BOOK_TABLE);
        $this->_user = (Session::get('user')['info']) ? Session::get('user')['info'] : array();
    }

    public function listItem($arrParam, $option = null){
        if($option['task'] == 'books-in-cat'){
            $catID		= $arrParam['category_id'];
            $query[]	= "SELECT `id`, `name`, `picture`, `description`";
            $query[]	= "FROM `$this->table`";
            $query[]	= "WHERE `status`  = 1 AND `category_id` = '$catID'";
            $query[]	= "ORDER BY `ordering` ASC";

            $query		= implode(" ", $query);
            $result		= $this->fetchAll($query);
            return $result;
        }

        if($option['task'] == 'books-relate'){
            $bookID		= $arrParam['book_id'];
            $queryCate	= "SELECT `category_id` FROM `".$this->table."` WHERE id = '$bookID'";
            $resultCate	= $this->fetchRow($queryCate);
            $catID		= $resultCate['category_id'];

            $query[]	= "SELECT `id`, `name`, `picture`";
            $query[]	= "FROM `$this->table`";
            $query[]	= "WHERE `status`  = 1 AND `category_id` = '$catID' AND `id` <> '$bookID'";
            $query[]	= "ORDER BY `ordering` ASC";

            $query		= implode(" ", $query);
            $result		= $this->fetchAll($query);
            return $result;
        }
    }

    public function infoItem($arrParam, $option = null){
        if($option['task'] == 'get-cat-name'){
            $query	= "SELECT `name` FROM `".CATEGORY_TABLE."` WHERE `id` = '" . $arrParam['category_id'] . "'";
            $result	= $this->fetchRow($query);
            return $result['name'];
        }

        if($option['task'] == 'book-info'){
            $query	= "SELECT `id`, `name`, `price`, `sale_off`, `picture`, `description` FROM `".$this->table."` WHERE `id` = '" . $arrParam['book_id'] . "'";
            $result	= $this->fetchRow($query);
            return $result;
        }
    }
}