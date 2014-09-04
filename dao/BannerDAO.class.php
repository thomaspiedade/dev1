<?php
class BannerDAO{
	public $insertId;// last inserted id in table
	public $total; //total of rows for an consult
	private $table = 'banners'; // table in database
	private $storage; 	
	/*
		construct method
		@var object $storage -> instance of storage;
	*/	
	public function __construct(Storage $storage){
		$this->storage 	= $storage;
	}	
	/*
		getById method
		@var integer $id ->  id of profuct to get data
	*/
	public function getById($id){
		return $this->storage->selectOne($this->table, array('cod = ' . $id));		
	}	
	
	/*
		findAll method
		@var array $where -> array with conditions of list
		@var array $fields -> array with fields of list
		@var others $fields -> array with others arguments (ORDER BY, ETC) of list
	*/

	//Select list of itens with an condition
	public function findAll($where, $fields = '*', $others = null,$debug = 0){
		if($where != null) $where = (is_array($where) ? $where : array($where));
		$data 		 = $this->storage->select($this->table,$where,$fields, $others ,$debug );
		$this->total = $this->storage->qrcount;
		return $data;
	}
	
	/*
		update method
		@var object instance $Banner -> instance of Banner 
	*/
	public function insert(Banner $Banner){
		$data  = array(
			'nome'		=> $Banner->getNome(),
			'descricao'	=> $Banner->getDescricao(),
			'path'		=> $Banner->getPath(),
			'ativo'	    => $Banner->getAtivo(),
			'link'	    => $Banner->getLink(),
			'tipo'	    => $Banner->getTipo(),
			'prioridade'=> $Banner->getPrioridade(),
			'cod_user'  => $Banner->getUser(),
			'dt_cad'   	=> $Banner->getDt_cad()		
		);		
		$return = $this->storage->insert($this->table, $data);
		$this->insertId = $this->storage->insertId;
		return $return;		
	}
	
	/*
		update method
		@var object instance $Banner -> instance of Banner 
		@var integer $id ->  id to update
	*/
	public function update(Banner $Banner){
		$data  = array(
			'nome'		=> $Banner->getNome(),
			'descricao'	=> $Banner->getDescricao(),
			'path'		=> $Banner->getPath(),
			'ativo'	    => $Banner->getAtivo(),
			'link'	    => $Banner->getLink(),
			'tipo'	    => $Banner->getTipo(),
			'prioridade'=> $Banner->getPrioridade()
		);		
		return $this->storage->update($this->table,$data, array( 'cod=' . $Banner->getId()));
	}
	
	/*
		delete method
		@var integer $id ->  id to delete
	*/

	public function delete($id){
		if(empty($id)) return false;
		return $this->storage->delete($this->table,array('cod = ' . $id));
	}


	/*
		getByType method
		@var integer $type ->  type of banner to get 
	*/
	public function getByType($type){
		return $this->storage->select($this->table, array('tipo = "' . $type . '" ORDER BY prioridade ASC'));		
	}	
}