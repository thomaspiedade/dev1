<?php 
Class Session{

	private static $storage;	

	public static function start(SessionStorage $storage){
		self::$storage = $storage;		
	}	
	
	public static function set($name, $data){		 
		self::$storage->update($name, $data);
	}
	
	public function get( $name = false ){	
		return ($name ? self::$storage->selectOne( $name ) : self::$storage->select());
	}
	
	public static function clear( $name = false ){
		return self::$storage->delete( $name );				
	}	
	
	public static function id(){		
		return self::$storage->id();
	}
	
	public static function destroy(){
		return self::$storage->delete();	
	}
	
	public static function check( $name = false ){
		if($name == false) return false;
		$data = self::$storage->selectOne( $name );
		return (!empty($data) && isset($data));
	}
}