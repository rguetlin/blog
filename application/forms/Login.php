<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');
        
        // Add an username element
        $this->addElement('text', 'userName', array(
            'label'      => 'User Name:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 29))
                )
        ));
 
        // Add the password element
        $this->addElement('password', 'userPassword', array(
            'label'      => 'Password:',
            'required'   => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 29))
                )
        ));
 
        // Add the submit button
        $this->addElement('submit', 'login', array(
            'ignore'   => true,
            'label'    => 'Login',
        ));     
    }


}

