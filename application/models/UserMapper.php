<?php

class Application_Model_UserMapper
{
	protected $_dbTable;
 
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
 
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_User');
        }
        return $this->_dbTable;
    }
 
    public function save(Application_Model_User $user)
    {
        $data = array(
            'userId'   => $user->getUserId(),
            'userName'   => $user->getUserName(),
            'userPassword'   => $user->getUserPassword(),
			'userRegDate'   => $user->getUserReg(),
			'userLastLogin'   => $user->getUserLastLogin(),
        );
		
        if (null === ($id = $user->userId())) {
            unset($data['userId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('userId = ?' => $userId));
        }
    }
 
    public function find($userId, Application_Model_User $user)
    {
        $result = $this->getDbTable()->find($userId);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $user->setUserId($row->userId)
                  ->setUserName($row->userName)
                  ->setUserPassword($row->userPassword)
                  ->setUserReg($row->userRegDate)
				  ->setUserLastLogin($row->userLastLogin);
    }
 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $users   = array();
        foreach ($resultSet as $row) {
            $user = new Application_Model_User();
            $user ->setUserId($row->userId)
                  ->setUserName($row->userName)
                  ->setUserPassword($row->userPassword)
                  ->setUserReg($row->userRegDate)
				  ->setUserLastLogin($row->userLastLogin);
            $users[] = $user;
        }
        return $users;
    }

}

