<?php

class UserController extends Zend_Controller_Action
{

    protected $flashMessenger;

    protected $userApi;

    protected $typeApi;

    public function init()
    {
        $this->flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->userApi = new Service_User();
        $this->typeApi = new Service_Type();
        $this->view->messages = $this->flashMessenger->getMessages();
    }

    public function addAction()
    {
        $this->view->headTitle("Ajout utilisateur");
        $form = new Form_User_Add();
        
        $Liste_type = new Zend_Form_Element_Select('Liste_type');
        $Liste_type->setLabel('Le type est : ')
            ->setRequired(true)
            ->setOrder(5);
        
        $user_types = $this->typeApi->fetchAll();
        foreach ($user_types as $type) {
            $Liste_type->addMultiOptions(array(
                $type->getId() => $type->getLable()
            ));
        }
        $form->addElement($Liste_type);
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()
                ->getPost())) {
                
                $user = new Model_User();
                $user->setName($form->getValue('username'));
                $user->setPassword($form->getValue('password'));
                $user->setMail($form->getValue('mail'));
                $user->setType_id($form->getValue('Liste_type'));
                
                if ($this->userApi->save($user)) {
                    $this->flashMessenger->addMessage('Utilisaeur créé');
                    $redirector = $this->_helper->getHelper('Redirector');
                    $redirector->setCode(302)
                        ->setExit(true)
                        ->setGotoRoute(array(), 'userListe');
                } else {
                    $this->flashMessenger->addMessage('La création a échoué');
                }
            }
        }
        $this->view->form = $form;
        
        //
        
        // // insert
        // if (isset($_POST['submit']) && ! empty($_POST)) {
        
        // // Incomplet
        // $user = new Model_User();
        // $user->setName($_POST['username']);
        // $user->setPassword($_POST['password']);
        
        // if ($this->userApi->save($user) != null) {
        // $this->flashMessenger->addMessage("Votre ajout a réussi");
        // } else{
        // $this->flashMessenger->addMessage("Impossible d'effectuer cette requete");
        
        // }
        // $redirector = $this->_helper->getHelper('Redirector');
        // $redirector->setCode(302)
        // ->setExit(true)
        // ->setGotoRoute(array(), 'userListe');
        // }
    }

    public function listeAction()
    {
        $this->view->headTitle(" Liste des utilisateurs");
        $this->view->inlineScript()->prependFile('/js/user.js');
        $this->flashMessenger = "";
        // Read
        $usersAll = array();
        $users = $this->userApi->fetchAll();
        foreach ($users as $user) {
            $types = $this->typeApi->find($user->getType_id());
        }
        $this->view->users = $users;
    }

    public function editAction()
    {
        $this->view->headTitle("Modifier un utilisateur");
        $id = (int) $this->getRequest()->getParam('id');
        $user = $this->userApi->find($id);
        
        if (! $user) {
            $this->flashMessenger->addMessage('Utilisaeur inexsitant');
            $redirector = $this->_helper->getHelper('Redirector');
            $redirector->setCode(302)
                ->setExit(true)
                ->setGotoRoute(array(), 'userListe');
        }
        
        $form = new Form_User_Edit();
        
        $Liste_type = new Zend_Form_Element_Select('Liste_type');
        $Liste_type->setLabel('Le type est : ')
            ->setRequired(true)
            ->setOrder(5);
        
        $user_types = $this->typeApi->fetchAll();
        foreach ($user_types as $type) 
        {
            $Liste_type->addMultiOptions(array($type->getId() => $type->getLable() ));
        }
        $form->addElement($Liste_type);
        
        $form->getElement('password')->setRequired(false);
        $form->getElement('passC')->setRequired(false);
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) 
                {
                     $user->setName($form->getValue('username'));
                     $user->setMail($form->getValue('mail'));
                     $user->setType_id($form->getValue('Liste_type'));
                     $password = $form->getValue('password');
                        if (!empty($password)) 
                        {
                             $user->setPassword($form->getValue('password'));
                        }
                    
            
                    if ($this->userApi->save($user)) 
                    {
                        $this->flashMessenger->addMessage('Utilisaeur modifier');
                        $redirector = $this->_helper->getHelper('Redirector');
                        $redirector->setCode(302)
                                   ->setExit(true)
                                   ->setGotoRoute(array(), 'userListe');
                    } else {
                        $this->flashMessenger->addMessage('La modifiction a échoué');
                      
                    }
                }
        } else {
            $form->populate(array(
                'id' => $user->getId(),
                'username' => $user->getName(),
                'password' => $user->getPassword(),
                'mail' => $user->getMail(),
                'Liste_type' => $user->getType_id()
            ));
        }
        $this->view->form = $form;
    }

    public function deleteAction()
    {
        $id = (int) $this->getRequest()->getParam('id');
        
        if ($this->userApi->delete($id) != null) {
            
            $this->flashMessenger->addMessage("Utilisateur supprimé");
        } else {
            $this->flashMessenger->addMessage("Impossible d'effectuer cette requete");
        }
        $redirector = $this->_helper->getHelper('Redirector');
        $redirector->setCode(302)
            ->setExit(true)
            ->setGotoRoute(array(), 'userListe');
    }
}
