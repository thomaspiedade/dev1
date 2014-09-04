<?php
Class Group{

	private $id;
	private $name;
	private $description;


    public function __construct($name, $description){
        $this->name        = $name;
        $this->description = $description;
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
     * Gets the value of name.
     *
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }
    
    /**
     * Sets the value of name.
     *
     * @param mixed $name the name 
     *
     * @return self
     */
    public function setName($name){
        $this->name = $name;
    }

    /**
     * Gets the value of descripition.
     *
     * @return mixed
     */
    public function getDescription(){
        return $this->description;
    }
    
    /**
     * Sets the value of description.
     *
     * @param mixed $description the description 
     *
     * @return self
     */
    public function setDescription($description){
        $this->description = $description;
    }
}