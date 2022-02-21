<?php

class PizzaController extends Zend_Controller_Action
{
    public function init()
    {
        $messages = $this->_helper->flashMessenger->getMessages();
        if(!empty($messages)){
            $this->_helper->layout->getView()->message = $messages[0];
        }
    }

    public function indexAction()
    {

    }
}
