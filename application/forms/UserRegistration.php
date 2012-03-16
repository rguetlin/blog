<?php

class Application_Form_UserRegistration extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');
 
        // Add an username element
        $this->addElement('text', 'UserName', array(
            'label'      => 'User Name:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 29))
                )
        ));
 
        // Add the password element
        $this->addElement('password', 'UserPassword', array(
            'label'      => 'Password:',
            'required'   => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 29))
                )
        ));
 
        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Sign Up',
        ));
    }


}

