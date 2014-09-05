<?php
namespace App\Controllers;
use Respect\Rest\Routable;
use App\DAO\User as User;

class UserController implements Routable {
	
	private $storage;	
	
	public function __construct( $Storage ){
		$this->storage = new User( $Storage );
	}

	public function get( $id ){
		if($id == 'list'){
			return $this->storage->findAll();	
		}		
		return $this->storage->findById($id);
	}

	public function post(){
		
	}

}