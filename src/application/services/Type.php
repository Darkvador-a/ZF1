<?php


class Service_Type 
{
    
    private $userTypeMapper;
    public function getUserTypeMapper()
    {
        if (null === $this->userTypeMapper) {
            $this->userTypeMapper = new Model_Mapper_Type();
        }
        return $this->userTypeMapper;
    }
    
    public function find($id)
    {
        $cache =Zend_Controller_Front::getInstance()
        ->getParam('bootstrap')
        ->getResource('cachemanager')
        ->getCache('data1');
        if(!$user = $cache->load('user_type'. $id))  {
            $user =$this->getUserTypeMapper()->find($id);
            $cache->save($user);
        }
        return $user;
    }
    
    public function fetchAll($where = null, $order = null, $count = null, $offset = null)
    {
        return $this->getUserTypeMapper()->fetchAll($where, $order, $count, $offset);
    }
    
   
}