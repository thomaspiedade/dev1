<?php
Class DB{	
	public static $host;
	public static $name;
	public static $user;
	public static $pass;	
	public static function init(){		
		self::$host = 'localhost';
		self::$name = 'laravel';
		self::$user = 'root';
		self::$pass = '';				
	}
	public static function host(){
		return self::$host;
	}
	public static function name(){
		return self::$name;
	}
	public static function user(){
		return self::$user;
	}
	public static function pass(){
		return self::$pass;
	}
	public static function PDOInstance(){
		return new PDO('mysql:host='. self::$host .';dbname='. self::$name .';charset=utf8', self::$user, self::$pass);
	}	
}