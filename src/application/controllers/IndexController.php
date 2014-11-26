<?php

class IndexController extends Zend_Controller_Action
{

    protected $flashMessenger;

    public function init()
    {
        $this->flashMessenger = $this->_helper->getHelper('FlashMessenger');
    }

    public function indexAction()
    {
        // action body
        $this->view->var1 = 'test';
        $this->view->headMeta()->appendName('description', 'test');
        $this->view->headMeta()->appendName('keywords', 'test, test2');
        $this->view->headTitle("Page D'accueil");
        
        $userApi = new Service_User();
        $this->view->user = $userApi->find(0);
    }

    public function testAction()
    {
        $flashMessenger = $this->_helper->getHelper('FlashMessenger');
        
        $this->view->headTitle("Page de test");
        $this->view->message = $flashMessenger->getMessages();
    }

    public function testredirectAction()
    {
        $flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $flashMessenger->addMessage('Redirection effectuée');
        
        $redirector = $this->_helper->getHelper('Redirector');
        $redirector->setCode(301)
            ->setExit(true)
            ->setGotoRoute(array(), 'indexTest');
    }

 
}

