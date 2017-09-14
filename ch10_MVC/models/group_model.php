<?php
class Group_Model extends Model {
    public function __construct() {
        parent::__construct();
        $this->setTable('group_user');
    }
	
	public function listItems($options = null) {
    	$query = array();
    	
		$query[] 	= "SELECT `g`.`id`,`g`.`name`,`g`.`status`,`g`.`ordering`, COUNT(`u`.id) AS total";
		$query[] 	= "FROM `group_user` AS `g` LEFT JOIN `manage_user` AS `u` ON `g`.`id` = `u`.`group_id`";
		$query[] 	= "GROUP BY `g`.`id`";
		$query		= implode(" ", $query);
		
		$result = $this->listRecord($query);
		return $result;
	}
	
	public function deteteGroup($id, $options = null) {
		$this->delete(array($id));
	}
}