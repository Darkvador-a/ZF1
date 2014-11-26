<?php 

class Model_User 
{
    private $id;
    private $name; 
    private $password;
    private $mail;
    private $type_id;
	/**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

	/**
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

	/**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

	/**
     * @param field_type $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

	/**
     * @return the $password
     */
    public function getPassword()
    {
        return $this->password;
    }

	/**
     * @param field_type $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
	/**
     * @return the $mail
     */
    public function getMail()
    {
        return $this->mail;
    }

	/**
     * @param field_type $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

	/**
     * @return the $type_id
     */
    public function getType_id()
    {
        return $this->type_id;
    }

	/**
     * @param field_type $type_id
     */
    public function setType_id($type_id)
    {
        $this->type_id = $type_id;
    }


    
    
	
    
    
}