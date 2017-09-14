<?php

class Database {
    protected $conn;
    protected $table;
    protected $resultQuery;
    
    
    public function __construct($params) {
        $link = mysqli_connect($params['server'], $params['username'], $params['password'], $params['database']);
        if (!$link) {
            die('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
        } else {
            $this->conn = $link;
            $this->table = $params['table'];
            $this->query("SET NAMES 'utf8'");
            $this->query("SET CHARACTER SET 'utf8'");
        }
    }
    
    public function __destruct() {
        mysqli_close($this->conn);
    }
    
    public function insert($data, $type = 'single') {
        if ($type == 'single') {
            $newQuery = $this->createInsertSQL($data);
            $query = "INSERT INTO `$this->table`(" . $newQuery['cols'] . ") VALUES (" . $newQuery['vals'] . ")";
            mysqli_query($this->conn, $query);
        } else {
            foreach ($data as $value) {
                $newQuery = $this->createInsertSQL($value);
                $query = "INSERT INTO `$this->table`(" . $newQuery['cols'] . ") VALUES (" . $newQuery['vals'] . ")";
                mysqli_query($this->conn, $query);
            }
        }
        
        return $this->lastID();
    }
    
    public function createInsertSQL($data) {
        $newQuery = array();
        $cols = '';
        $vals = '';
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $cols .= ", `$key`";
                $vals .= ", '$value'";
            }
        }
        $newQuery['cols'] = substr($cols, 2);
        $newQuery['vals'] = substr($vals, 2);
        
        return $newQuery;
    }
    
    public function lastID() {
        return mysqli_insert_id($this->conn);
    }
    
    public function query($query) {
        return $this->resultQuery = mysqli_query($this->conn, $query);
    }
    
    public function update($data, $where) {
        $newSet = $this->createUpdateSQL($data);
        $newWhere = $this->createWhereUpdateSQL($where);
        $query = "UPDATE `$this->table` SET " . $newSet . " WHERE $newWhere";
        $this->query($query);
        
        return $this->affectedRows();
    }
    
    // CREATE UPDATE SQL
    public function createUpdateSQL($data) {
        $newQuery = "";
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $newQuery .= ", `$key` = '$value'";
            }
        }
        $newQuery = substr($newQuery, 2);
        
        return $newQuery;
    }
    
    // CREATE WHERE UPDATE SQL
    public function createWhereUpdateSQL($data) {
        $newWhere = '';
        if (!empty($data)) {
            foreach ($data as $value) {
                $newWhere[] = "`$value[0]` = '$value[1]'";
                $newWhere[] = $value[2];
            }
            $newWhere = implode(" ", $newWhere);
        }
        
        return $newWhere;
    }
    
    // tra ve tong so dong vua thuc hien
    public function affectedRows() {
        return mysqli_affected_rows($this->conn);
    }
    
    // DELETE
    public function delete($where) {
        $newWhere = $this->createWhereDeleteSQL($where);
        $query = "DELETE FROM `$this->table` WHERE `id` IN ($newWhere)";
        $this->query($query);
        
        return $this->affectedRows();
    }
    
    // CREATE WHERE DELTE SQL
    public function createWhereDeleteSQL($data) {
        $newWhere = '';
        if (!empty($data)) {
            foreach ($data as $id) {
                $newWhere .= "'" . $id . "', ";
            }
            $newWhere .= "'0'";
        }
        
        return $newWhere;
    }
    
    public function listRecord($query) {
        $result = array();
        if (!empty($query)) {
            $resultQuery = $this->query($query);
            if (mysqli_num_rows($resultQuery) > 0) {
                while ($row = mysqli_fetch_assoc($resultQuery)) {
                    $result[] = $row;
                }
                mysqli_free_result($resultQuery);
            }
        }
        
        return $result;
    }
    
    public function singleRecord($query) {
        $result = array();
        if (!empty($query)) {
            $resultQuery = $this->query($query);
            if (mysqli_num_rows($resultQuery) > 0) {
                $result = mysqli_fetch_assoc($resultQuery);
            }
        }
//        mysqli_free_result($resultQuery);
        return $result;
    }
    
    public function checkExit ($query){
        if ($query != null) {
            $this->resultQuery = $this->query($query);
        }
        return (mysqli_num_rows($this->resultQuery) > 0) ? true : false;
    }
    
    public function countItem($query) {
        if (!empty($query)) {
            $resultQuery = $this->query($query);
        }
        
        return (mysqli_num_rows($resultQuery)) ? mysqli_num_rows($resultQuery) : 0;
    }
}