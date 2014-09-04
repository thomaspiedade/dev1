<?php
Class UsersGroupsDAO{
	
	public  $insertId;// last inserted id in table
	public  $total; //total of rows for an consult
	private $table = 'users_groups'; // table in database
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
		@var integer $id ->  id of UsersGroups to get data
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
		@var object instance $UsersGroups -> instance of UsersGroups 
	*/
	public function insert(UsersGroups $UsersGroups){
		$data  = array(
			'id_user'  => $UsersGroups->getIdUser(),			
			'id_group' => $UsersGroups->getIdGroup()			
		);		
		$return = $this->storage->insert($this->table, $data);
		$this->insertId = $this->storage->insertId;
		return $return;		
	}
	
	/*
		update method
		@var object instance $UsersGroups -> instance of UsersGroups 
		@var integer $id ->  id of UsersGroups to update
	*/
	public function update(UsersGroups $UsersGroups ,$id){	
		if(empty($id)) return false;
		$data  = array(
			'id_user'  => $UsersGroups->getIdUser(),			
			'id_group' => $UsersGroups->getIdGroup()			
		);		
		return $this->storage->update($this->table,$data, array('id = "'.$id.'"'));
	}	
	/*
		delete method
		@var integer $id ->  id of departament to delete
	*/
	public function delete( $id ){
		return (empty($id) ? false : $this->storage->delete($this->table,array('id = ' . $id)));
	}

	public function deleteByUserId( $id ){
		return (empty($id) ? false : $this->storage->delete($this->table,array('id_user = ' . $id)));
	}

	public function getByUserId( $id_user ){
		$data 		 = $this->storage->select($this->table, array('id_user=' . $id_user));
		$this->total = $this->storage->qrcount;
		return $data;
	}


	public function getGroupNamesByUserId( $id_user ){
		$this->storage->query = 'SELECT groups.name FROM users_groups INNER JOIN groups ON groups.id = users_groups.id_group WHERE users_groups.id_user = ' .$id_user;
		$this->storage->execute_query();
		$groups = array();
		foreach ($this->storage->querydata as $group){
			array_push($groups, $group['name']);
		}
		return $groups;
	}

	public function getByGroupId( $id_group ){
		$data 		 = $this->storage->select($this->table, array('id_group=' . $id_group));
		$this->total = $this->storage->qrcount;
		return $data;
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