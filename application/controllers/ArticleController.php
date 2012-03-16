<?php

class ArticleController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $articleMapper = new Application_Model_ArticleMapper();
        $this->view->articles = $articleMapper->fetchAll();
    }


}

