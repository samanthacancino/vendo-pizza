<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initView()
    {
        $view = $this->bootstrap('layout')->getResource('layout')->getView();
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'Application_Views_Helpers');

        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
        $viewRenderer->setView($view);

        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
    }

    public function _initREST()
    {
    }
}

