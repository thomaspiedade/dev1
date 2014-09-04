<?php
Class PDOStorage implements Storage{ 	
	public 		$qrcount,$insertId, $error, $querydata, $query;	
	protected 	$pdo;
	public function __construct(PDO $pdo){		
		$this->pdo = $pdo;	
	}
	
	public function execute_query(){//FUNÇÃO EXECUÇÃO DE QUERIES EM GERAL
		$this->qrcount = 0;
		unset($this->querydata);					
		if(! $result = $this->pdo->query($this->query) ) return false;
		$result->setFetchMode(PDO::FETCH_ASSOC);		
		$this->querydata = $result->fetchAll();	
		$this->qrcount 	 = count($this->querydata);
		return true;		
	}	
	
	public function insert($table, array $data){		
		foreach($data as $field => $value){
			$fields[] = $field;
			$values[] = ($value == NULL ? 'NULL' : $value); 
		}
		$bindvalues = ':' . implode(', :',$fields);				
		$fields 	= implode(', ',$fields);
		$sth = $this->pdo->prepare('INSERT INTO ' . $table . ' (' . $fields . ') VALUES (' . $bindvalues . ')');
		foreach ($data as $f => $v){
			$sth->bindValue(':' . $f, $v);
		}
		if(!$sth->execute()){
			$this->setError(print_r($sth->errorInfo(), true));
			echo $this->getError();
		}	
		$this->setInsertId($this->pdo->lastInsertId());
		return true;		
	}
	public function select($table, array $where = null, $fields = '*'){			
		$where  = ($where  != null ? ' WHERE '.implode(' AND ',$where) : '');
		$others = ($others != null ? implode(' ',$others) : '');		
		if(is_array($fields) || $fields == null){
			$fields = ($fields == null ? '*' : implode(', ', $fields));			
		}
		$sql = "SELECT {$fields} FROM {$table} {$where} {$others}";
		$this->qrcount = 0;
		if( !$result = $this->pdo->query($sql) ) return false;
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$data = $result->fetchAll();		
		$this->qrcount = count($data);			
		return $data;				
	}// select

	public function selectOne($table, array $where = null){	
		$this->qrcount = 0;		
		$where  = ($where  != null ? ' WHERE '.implode(' AND ',$where) : '');
		$others = ($others != null ? implode(' ',$others) : '');		
		$sql 	= "SELECT * FROM {$table} {$where} {$others}";		
		if( ! $result = $this->pdo->query($sql) ) return false;	
		$this->qrcount = $result->rowCount();			
		return $result->fetch(PDO::FETCH_ASSOC);			
	}// select
	
	public function update($table, array $data, $where = ''){		
		if(is_array($where)){		
			$where  = ($where  != null ? ' WHERE '.implode(' AND ',$where) : '');
		}elseif($where != ''){		
			$where  = ' WHERE '.$where;
		}		
		foreach($data as $field => $value){
			$fields[] = $field .' = ' . ($value == NULL ? 'NULL' : '"' .$value. '"' );				
		}					
		$sets = implode(', ',$fields);	
		$sql  = "UPDATE {$table} SET {$sets} {$where}";	
		$result = $this->pdo->prepare($sql);
     	if (!$result->execute()){
     		$this->setError( print_r($result->errorInfo(), true) );	
     	}
     	return true;
	}// update
	
	public function delete($table, array $where){
		if(empty($where)) return false;
		if(is_array($where)){		
			$where  = ($where  != null ? ' WHERE '.implode(' AND ',$where) : '');
		}elseif($where != ''){		
			$where  = ' WHERE ' . $where;
		}
		return $this->pdo->query("DELETE FROM {$table} {$where}");
	}// delete	

	public function setInsertId($insertId){
		$this->insertId = $insertId;
	}
		
	public function getInsertId() {
		return $this->insertId;
	}
	
	public function	getError(){
		return $this->error;
	}
	
	public function	setError( $err ){
		$this->error = $err;
	}
}