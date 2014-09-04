<?php
class User{

	private $id;
	private $name;
	private $email;
	private $status;
	private $level;
	private $password;	

	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	
	public function getName(){
		return $this->name;
	}
	public function setName($name){
		$this->name = $name;
	}	
	
	public function getEmail(){
		return $this->email;
	}
	public function setEmail($email){
		$this->email = $email;
	}

	public function getStatus(){
		return $this->status;
	}
	public function setStatus($status){
		$this->status = $status;
	}

	public function getLevel(){
		return $this->level;
	}
	public function setLevel($level){
		$this->level = $level;
	}	

	public function getPassword(){
		return $this->password;
	}
	public function setPassword($password){
		$this->password = $password;
	}
}