<?php
namespace App\DAO;
class User{
	public $lastInsertId;// last inserted id in table
	public $total; //total of rows for an consult
	private $table = 'users'; // table in database
	private $storage; // instance of storage	
	/*
		construct method
		@var object $storage -> instance of storage;
	*/	
	public function __construct( $storage ){
		$this->storage 	= $storage;
	}
		
	/*
		getById method
		@var integer $id ->  id of user to get data
	*/
	public function findById($id){
		return $this->storage->selectOne($this->table, array('id = ' . $id));
	}	
	
	
	/*
		findAll method -> Select list of itens with an condition
		@var array $where -> array with conditions of list
		@var array $fields -> array with fields of list
		@var array $others -> array with others arguments (ORDER BY, ETC) of list
	*/	
	
	public function findAll(){
		$data 		 = $this->storage->select($this->table);
		$this->total = $this->storage->qrcount;
		return $data;
	}

	/*
		find method -> Select list of itens with an condition
		@var array $where -> array with conditions of list		
	*/	
	
	public function find(array $where = NULL){
		$data 		 = $this->storage->select($this->table,$where);
		$this->total = $this->storage->qrcount;
		return $data;
	}
	
	/*
		insert method
		@var object instance $user -> instance of user 
	*/
	public function insert(User $user){
		$data  = array(
			'name' 		=> $user->getName(),
			'email' 	=> $user->getEmail(),
			'level' 	=> $user->getLevel(),
			'password' 	=> md5($user->getPassword()),									
			'status' 	=> $user->getStatus(),
			'created_at'=> date('Y-m-d H:i:s')	
		);	
		$return = $this->storage->insert($this->table, $data);
		$this->lastInsertId = $this->storage->insertId;
		return $return;		
	}
	
	/*
		update method
		@var object instance $user -> instance of user 
		@var integer $cod_user ->  id of user to update
	*/
	public function update(User $user ,$id){	
		if(empty($id)) return false;
		$data  = array(
			'name' 		=> $user->getName(),
			'email' 	=> $user->getEmail(),
			'level' 	=> $user->getLevel(),
			'password' 	=> md5($user->getPassword()),									
			'status' 	=> $user->getStatus(),
			'updated_at'=> date('Y-m-d H:i:s')	
		);	
		return $this->storage->update($this->table,$data, array('id =' . $id));
	}
	
	/*
		delete method
		@var integer $id ->  id of user to delete
	*/
	public function delete($id){
		if(empty($id)) return false;		
		return $this->storage->delete($this->table, array('id = ' . $id ) );
	}


	public function deleteByEmail($email){
		if(empty($email)) return false;		
		return $this->storage->delete($this->table, array('email LIKE "%'.$email.'%"'));
	}

	/*
		updatePassword method
		@var array $where ->  data for condition to change pass word;
		@var string $newPassword -> new passarword to update;
	*/
	public function updatePassword(Array $where, $newPassword){
		if(empty($newPassword) || empty($where)) return false;
		return $this->storage->update($this->table, array('senha' => md5($newPassword)), $where);
	}

	/*
		getByEmail method
		@var string $email ->  email of user to get data
	*/
	public function getByEmail($email){
		return $this->storage->selectOne($this->table, array('email = "' . $email . '"'));
	}	

	public function inGroup($id_user, $groups ){
		$groups = ( is_array($groups) ? implode('","' ,  $groups  ) : $groups);
		$this->storage->query = 'SELECT * FROM users_groups INNER JOIN groups ON users_groups.id_group = groups.id WHERE users_groups.id_user = ' .  $id_user . ' AND groups.name IN ("'. $groups .'")'; 
		$this->storage->execute_query();
		return $this->storage->qrcount;
	}
}