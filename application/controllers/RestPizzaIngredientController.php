<?php

/**
 * @category Neo
 * @package ...
 * @copyright Vendo Services, GmbH
 */
class RestPizzaIngredientController extends Zend_Rest_Controller
{
    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout()->disableLayout();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
    }

    public function indexAction()
    {
        $this->getResponse()->setHttpResponseCode(404);
    }

    public function getAction()
    {
        $this->getResponse()->setHttpResponseCode(404);
    }

    public function postAction()
    {
        $this->getResponse()->setHttpResponseCode(404);
    }

    public function putAction()
    {
        $id = $this->getRequest()->getParam('id');

        if (!isset($id)) {
            throw new Exception('ID not specified');
        }

        $pizzasTable = new Application_Model_DbTable_Pizzas();
        $pizza = $pizzasTable->fetchRow($pizzasTable->select()->where('id = ?', (int)$id));

        if (!isset($pizza)) {
            throw new Exception('Pizza not found');
        }

        $form = new Application_Form_PizzaIngredient();

        if ($form->isValid($this->getRequest()->getParams())) {
            $formValues = $form->getValues();

            $table = new Application_Model_DbTable_PizzaIngredient();
            $row = $table->createRow();
            $row->pizza_id = $id;
            $row->ingredient_id = $formValues['ingredient_id'];
            $row->quantity = $formValues['quantity'];
            $row->save();

            $response = [
                'message' => 'Ingredient added to pizza',
            ];
            $this->getResponse()->setHttpResponseCode(200);
        } else {
            $response = [
                'message' => 'Ingredient not added to pizza',
                'errors' => $form->getErrors(),
            ];
            $this->getResponse()->setHttpResponseCode(400);
        }

        $this->getResponse()->setBody(json_encode($response));
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');

        if (!isset($id)) {
            throw new Exception('ID not specified');
        }

        $pizzasTable = new Application_Model_DbTable_Pizzas();
        $pizza = $pizzasTable->fetchRow($pizzasTable->select()->where('id = ?', (int)$id));

        if (!isset($pizza)) {
            throw new Exception('Pizza not found');
        }

        $table = new Application_Model_DbTable_PizzaIngredient();
        $table->delete(['pizza_id = ' . (int)$id]);

        $response = [
            'message' => 'All ingredients deleted for pizza',
            'id' => $id,
        ];

        $this->getResponse()->setBody(json_encode($response));
        $this->getResponse()->setHttpResponseCode(200);
    }

    public function headAction()
    {
        $this->getResponse()->setBody(null);
    }

    public function optionsAction()
    {
        $this->getResponse()->setBody(null);
        $this->getResponse()->setHeader('Allow', 'OPTIONS, HEAD, INDEX, GET, POST, PUT, DELETE');
    }
}
