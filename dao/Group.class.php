<?php
namespace App\DAO;
Class Group{
	
	public $insertId;// last inserted id in table
	public $total; //total of rows for an consult
	private $table = 'groups'; // table in database
	private $storage; // instance of storage	
	/*
		construct method
		@var object $storage -> instance of storage;
	*/	
	public function __construct(Storage $storage){
		$this->storage 	= $storage;
	}
		
	/*
		getData method
		@var integer $id ->  id of Group to get data
	*/
	public function getById($id){
		return $this->storage->selectOne($this->table, array('id = ' . $id));
	}	
	
	/*
		getList method -> Select list of itens with an condition
		@var array $where -> array with conditions of list
		@var array $fields -> array with fields of list
		@var array $others -> array with others arguments (ORDER BY, ETC) of list
	*/	
	public function findAll($where = NULL, $fields = '*', $others = NULL,$debug = 0){
		if($where != NULL) $where = (is_array($where) ? $where : array($where));
		$data 		 = $this->storage->select($this->table,$where,$fields, $others ,$debug );
		$this->total = $this->storage->qrcount;
		return $data;
	}
	
	/*
		update method
		@var object instance $Group -> instance of Group 
	*/
	public function insert(Group $Group){
		$data  = array(
			'name' 		  => $Group->getName(),			
			'description' => $Group->getDescription()			
		);		
		$return = $this->storage->insert($this->table, $data);
		$this->insertId = $this->storage->insertId;
		return $return;		
	}
	
	/*
		update method
		@var object instance $Group -> instance of Group 
		@var integer $id ->  id of Group to update
	*/
	public function update(Group $Group ,$id){	
		if(empty($id)) return false;
		$data  = array(
			'name' 		  => $Group->getName(),			
			'description' => $Group->getDescription()			
		);		
		return $this->storage->update($this->table,$data, array('id = "'.$id.'"'));
	}
	
	/*
		delete method
		@var integer $id ->  id of departament to delete
	*/
	public function delete($id){
		return (empty($id) ? false : $this->storage->delete($this->table,array('id = ' . $id)));
	}

	public function hasUser($groups, $id_user){
		$groups = ( is_array($groups) ? implode('","' ,  $groups  ) : $groups);
		$this->storage->query = 'SELECT * FROM users_groups INNER JOIN groups ON users_groups.id_group = groups.id WHERE users_groups.id_user = ' .  $id_user . ' AND groups.name IN ("'. $groups .'")'; 
		$this->storage->execute_query();
		return $this->storage->qrcount;
	}

	public function getByName( $string ){
		return $this->storage->selectOne($this->table, array('name= "' . $string . '"'));
	}

	public function getUsersByGroupName( $name = false ){
		if($name == false) return false;
		$this->storage->query = 'SELECT users_groups.id_user FROM users_groups INNER JOIN groups ON groups.id = users_groups.id_group WHERE groups.name = "'.$name.'"';
		$this->storage->execute_query();
		$users = array();
		foreach ($this->storage->querydata as $user){
			array_push($users, $user['id_user']);
		}
		return $users;
	}
}