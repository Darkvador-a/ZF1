<?php

class Form_User_Add extends Zend_Form
{

    public function init()
    {
        $this->addElement('text', 'username', array(
            'label' => 'Username',
            'placeholder' => 'ex: Jhon'
        ));
        
        $this->getElement('username')
            ->setRequired(true)
            ->addValidator(new Zend_Validate_Alnum())
            ->setOrder(1);
        
        $this->addElement('text', 'mail', array(
            'label' => 'Mail',
            'placeholder' => 'ex: jhon@example.com'
        ));
        
        $this->getElement('mail')
        ->setRequired(true)
        ->addValidator(new Zend_Validate_EmailAddress())
        ->setOrder(2);
        
        $this->addElement('password', 'password', array(
            'label' => 'Password'
        ));
        
        $this->getElement('password')
            ->setRequired(true)
            ->addValidator(new Zend_Validate_StringLength(array(
            'min' => 6 )))
             ->setOrder(3);
            
      $this->addElement('password', 'passC', array(
                'label' => 'Confirmer password'
            ));
            
       $this->getElement('passC')
            ->setRequired(true)
            ->addValidator(new Zend_Validate_StringLength(array(
                'min' => 6 )))
                ->setOrder(4)
            ->addValidator('Identical', false, array('token' => 'password'));;
        
      
        
        $this->addElement('submit', 'send', array(
            'label' => 'Send',
            'class' => 'btn btn-primary'
        ));
        $this->getElement('send')->setOrder(6);
    }
}