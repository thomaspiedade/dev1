<?php 
interface Storage{	
	/*
	 * @var container - define container to insert data (Ex.: Xls File, database table, etc );
	 * @var array data -  data to insert/update in container
	 * @var array condition - define conditions to select delete or update container 
	*/	
	public function insert($container, array $data);//insert
	public function select($container, array $condition, $fields);// select
	public function selectOne($container,array $condition);// selectOne	
	public function update($container, array $data, $condition);// update	
	public function delete($container, array $condition);// delete
}