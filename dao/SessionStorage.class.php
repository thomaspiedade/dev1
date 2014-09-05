<?php
namespace App\DAO;
Class SessionStorage{
	
	private $id;

	public function __construct( $id = false){
		session_start();
		$this->id = ($id == false ? session_id() : session_id( $id ));
	}

	public function insert($name, $data){
		$_SESSION[$this->id][$name] = $data;
		return true;		
	}

	public function select(){	
			return $_SESSION[$this->id];	
	}// select

	public function selectOne( $name ){	
		return $_SESSION[$this->id][$name];
	}// select
	
	public function update($name, $data){		
		$_SESSION[$this->id][$name] = $data;
		return true;
	}// update
	
	public function delete($name = false){
		if($name == false) {
			unset($_SESSION[$this->id]);
		}else{
			unset($_SESSION[$this->id][$name]);
		}
		return true;
	}// delete

	public function id(){		
		return $this->id;
	}
}