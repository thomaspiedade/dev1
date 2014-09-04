<?php 
class Auth{
	
	public static function login( User $User, UserDAO $UserDAO ){
		$result = $UserDAO->findAll(array('email = "' . $User->getEmail() . '"', 'password = "' . md5($User->getPassword()) . '"'));
		return count($result);
	}

	public static function isLogged(){
		$user = Session::get('user');
		return ( !empty( $user ) );
	}

	public static function logout(){
		Session::clear();
		return true;	
	}

	public static function user(){
		return Session::get('user');		
	}

}