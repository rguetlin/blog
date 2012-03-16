<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $userMapper = new Application_Model_UserMapper();
        $this->view->users = $userMapper->fetchAll();
    }

    public function regAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_UserRegistration();
 
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $user = new Application_Model_User($form->getValues());
				$user 	->setUserReg(date('Y-m-d H:i:s',time()))
						->setUserLastLogin(date('Y-m-d H:i:s',time()));
                $userMapper  = new Application_Model_UserMapper();
                $userMapper ->save($user);
				
                return $this->_helper->redirector('index');
            }
        }
 
        $this->view->form = $form;
    }


}





