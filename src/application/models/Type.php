<?php


class Model_Type
{
    private $id;
    private $lable;
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
     * @return the $lable
     */
    public function getLable()
    {
        return $this->lable;
    }

	/**
     * @param field_type $lable
     */
    public function setLable($lable)
    {
        $this->lable = $lable;
    }

    
    
}
