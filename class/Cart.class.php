<?php
class Cart{		
	private $cart = array();
	private $container;

	public function __construct( $container ){
		$this->container  = $container;
		$this->cart = Session::get( $container );
		$this->cart = ( isset( $this->cart ) ? $this->cart : array() );
	}	

	//New methods
	public function add($key, $data){
		 $this->cart[$key]	= $data;
		 $this->update();
		 return true;			
	}

	public function remove($key = false){
		if($key == false) return false;
		unset($this->cart[$key]);
		$this->update();
		return true;
	}

	public function get($key = false){
		return $key == false ? $this->cart :  $this->cart[$key];		
	}

	public function clear(){
		unset($this->cart);
		$this->update();
	}

	public function getTotal(){
		return (isset($this->cart) ? count($this->cart) : 0 );
	}

	public function hasItem($key){
		return ($this->getTotal() == 0 ? false : array_key_exists($key , $this->cart ));
	}

	public function update(){		
		Session::clear( $this->container );
		Session::set($this->container, $this->cart);	
	}

	public function pesoTotal($total = 0){
		foreach($this->get() as $item)	$total =  $total + $item['bytes'];		
		return $total;
	}

	public function getByType($type){
		foreach($this->get() as $item){
			if($item['tipo'] == $type) $itens[$item['cod_arquivo']] = $item;
		}		
		return $itens;
	}
}