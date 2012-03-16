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


}

