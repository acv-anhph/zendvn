<?php
class Database{
    protected $conn;
    protected $table;

    public function __construct($params)
    {
        $link = mysqli_connect($params['server'], $params['user'], $params['password'], $params['database']);
        if (!$link) {
            die('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
        }else{
            $this->conn = $link;
            $this->table = $params['table'];
        }
    }

    public function __destruct()
    {
        mysqli_close($this->conn);
    }


    public function insert($data, $type = 'single'){
        if ($type == 'single'){
            $newQuery 	= $this->createInsertSQL($data);
            $query 		= "INSERT INTO `$this->table`(".$newQuery['cols'].") VALUES (".$newQuery['vals'].")";
            mysqli_query($this->conn, $query);
        }else{

        }
    }

    public function createInsertSQL($data){
        $newQuery = array();
        $cols = '';
        $vals = '';
        if(!empty($data)){
            foreach($data as $key=> $value){
                $cols .= ", `$key`";
                $vals .= ", '$value'";
            }
        }
        $newQuery['cols'] = substr($cols, 2);
        $newQuery['vals'] = substr($vals, 2);
        return $newQuery;
    }
}