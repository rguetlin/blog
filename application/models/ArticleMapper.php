<?php

class Application_Model_ArticleMapper
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
            $this->setDbTable('Application_Model_DbTable_Article');
        }
        return $this->_dbTable;
    }
	
	public function save(Application_Model_Article $article)
    {
        $data = array(
            'articleId'   => $article->getArticleId(),
            'articleTitle'   => $article->getArtcleTitle(),
            'articleValue'   => $article->getArticleValue(),
			'articleLastEdit'   => $article->getArticleLastEdit(),
			'userId'   => $article->getUserId(),
        );
		
        if (null === ($id = $article->articleId())) {
            unset($data['articleId']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('articleId = ?' => $articleId));
        }
    }
 
    public function find($articleId, Application_Model_User $article)
    {
        $result = $this->getDbTable()->find($articleId);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $article  ->setArticleId($row->articleId)
                  ->setArticleTitle($row->articleTitle)
                  ->setArticleValue($row->articleValue)
                  ->setArticleLastEdit($row->articleLastEdit)
				  ->setUserId($row->userId);
    }
 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $articles   = array();
        foreach ($resultSet as $row) {
            $article = new Application_Model_Article();
            $article ->setArticleId($row->articleId)
                  ->setArticleTitle($row->articleTitle)
                  ->setArticleValue($row->articleValue)
                  ->setArticleLastEdit($row->articleLastEdit)
				  ->setUserId($row->userId);
            $articles[] = $article;
        }
        return $articles;
    }
}

