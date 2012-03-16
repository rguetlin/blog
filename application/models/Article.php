<?php

class Application_Model_Article
{
    protected $_articleId;
    protected $_articleTitle;
    protected $_articleValue;
    protected $_articleLastEdit;
	protected $_userId;
	
	public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
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
	
	public function setArticleId($articleId)
	{
		$this->_articleId = (int) $articleId;
        return $this;
	}
	
    public function getArticleId()
	{
		return $this->_articleId;
	}
 
    public function setArticleTitle($articleTitle)
	{
        $this->_articleTitle = (string) $articleTitle;
        return $this;
	}
	
    public function getArticleTitle()
	{
		return $this->_articleTitle;
	}
	
	public function setArticleValue($articleValue)
	{
		$this->_articleValue = (string) $articleValue;
        return $this;
	}
	
    public function getArticleValue()
	{
		return $this->_articleValue;
	}
 
    public function setArticleLastEdit($articleLastEdit)
	{
		$this->_articleLastEdit = $articleLastEdit;
        return $this;
	}
	
    public function getArticleLastEdit()
	{
		return $this->_articleLastEdit;
	}
	
	public function setUserId($userId)
	{
		$this->_userId = $userId;
        return $this;
	}
	
    public function getUserId()
	{
		return $this->_userId;
	}

}

