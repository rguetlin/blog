<?php

class Application_Model_User
{
    protected $_userId;
    protected $_userName;
    protected $_userPassword;
    protected $_userRegDate;
	protected $_userLastLogin;
	
	public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
	
	public function __set($name, $value)
	{
		$method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid user property');
        }
        $this->$method($value);
	}
	
    public function __get($name)
	{
		$method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid user property');
        }
        return $this->$method();
	}
	
	public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
	
	public function setUserId($userId)
	{
		$this->_userId = (int) $userId;
        return $this;
	}
	
    public function getUserId()
	{
		return $this->_userId;
	}
 
    public function setUserName($userName)
	{
        $this->_userName = (string) $userName;
        return $this;
	}
	
    public function getUserName()
	{
		return $this->_userName;
	}
	
	public function setUserPassword($userPassword)
	{
		$this->_userPassword = (string) $userPassword;
        return $this;
	}
	
    public function getUserPassword()
	{
		return $this->_userPassword;
	}
 
    public function setUserReg($userRegDate)
	{
		$this->_userRegDate = $userRegDate;
        return $this;
	}
	
    public function getUserReg()
	{
		return $this->_userRegDate;
	}
	
	public function setUserLastLogin($userLastLogin)
	{
		$this->_userLastLogin = $userLastLogin;
        return $this;
	}
	
    public function getUserLastLogin()
	{
		return $this->_userLastLogin;
	}
	
}	

