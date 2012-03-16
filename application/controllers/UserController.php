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
				
                return $this->_helper->redirector('index,', 'index');
            }
        }
 
        $this->view->form = $form;
    }
	
	public function loginAction()
    {
        $form = new Application_Form_Login();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                if ($this->_process($form->getValues())) {

                    $this->_helper->redirector('index', 'index');
                }
            }
        }
        $this->view->form = $form;
    }

    protected function _process($values)
    {
        $adapter = $this->_getAuthAdapter();
        $adapter->setIdentity($values['userName']); 
        $adapter->setCredential($values['userPassword']);

        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
        if ($result->isValid()) {
            $user = $adapter->getResultRowObject();
            $auth->getStorage()->write($user);
            return true;
        }
        return false;
    }

    protected function _getAuthAdapter()
    {
        
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        
        $authAdapter->setTableName('user')
					->setIdentityColumn('userName')
					->setCredentialColumn('userPassword');

        return $authAdapter;
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index', 'index'); // back to login page
    }


}





