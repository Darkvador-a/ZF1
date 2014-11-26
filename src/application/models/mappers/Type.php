<?php

class Model_Mapper_Type
{

    private $dbTable;

    public function find($id)
    {
        $rowSet = $this->getDbTable()->find($id);
        if (0 == count($rowSet->current())) {
            return false;
        }
        return $this->rowToObject($rowSet->current());
    }

    public function fetchAll($where = null, $order = null, $count = null, $offset = null)
    {
        $rowSet = $this->getDbTable()->fetchAll($where, $order, $count, $offset);
        $entities = array();
        foreach ($rowSet as $row) {
            $entities[] = $this->rowToObject($row);
        }
        return $entities;
    }

   

    public function getDbTable()
    {
        if ($this->dbTable === null) {
            $this->dbTable = new Model_DbTable_Type();
        }
        return $this->dbTable;
    }

    public function objectToRow($user_type)
    {
        return array(
            'user_type_id' => $user_type->getId(),
            'user_type_lable' => $user_type->getLable(),
        );
    }

    public function rowToObject($row)
    {
        $user_type = new Model_Type();
        $user_type->setId($row['user_type_id']);
        $user_type->setLable($row['user_type_lable']);
        return $user_type;
    }
}