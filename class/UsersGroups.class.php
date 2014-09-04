<?php
Class UsersGroups{	

	private $id;
	private $idUser;
	private $idGroup;

	public function __construct($idUser, $idGroup){
		$this->idUser  = $idUser;
		$this->idGroup = $idGroup;
	}

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId(){
        return $this->id;
    }
    
    /**
     * Sets the value of id.
     *
     * @param mixed $id the id 
     *
     * @return self
     */
    public function setId($id){
        $this->id = $id;

    }

    /**
     * Gets the value of idUser.
     *
     * @return mixed
     */
    public function getIdUser(){
        return $this->idUser;
    }
    
    /**
     * Sets the value of idUser.
     *
     * @param mixed $idUser the id user 
     *
     * @return self
     */
    public function setIdUser($idUser){
        $this->idUser = $idUser;

    }

    /**
     * Gets the value of idGroup.
     *
     * @return mixed
     */
    public function getIdGroup(){
        return $this->idGroup;
    }
    
    /**
     * Sets the value of idGroup.
     *
     * @param mixed $idGroup the id group 
     *
     * @return self
     */
    public function setIdGroup($idGroup){
        $this->idGroup = $idGroup;

    }
}