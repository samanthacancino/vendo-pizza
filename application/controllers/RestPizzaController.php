<?php

/**
 * @category Neo
 * @package ...
 * @copyright Vendo Services, GmbH
 */
class RestPizzaController extends Zend_Rest_Controller
{
    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout()->disableLayout();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
    }

    public function indexAction()
    {
        $pizzasTable = new Application_Model_DbTable_Pizzas();
        $pizzas = $pizzasTable->fetchAll();

        $this->getResponse()->setBody(\json_encode($pizzas->toArray()));
        $this->getResponse()->setHttpResponseCode(200);
    }

    public function getAction()
    {
        $id = (int)$this->getRequest()->getParam('id');

        if (!isset($id)) {
            throw new Exception('ID not specified');
        }

        $pizzasTable = new Application_Model_DbTable_Pizzas();
        $pizza = $pizzasTable->fetchRow($pizzasTable->select()->where('id = ?', $id));

        if (!isset($pizza)) {
            $this->getResponse()->setBody(json_encode([
                'status' => 'error',
                'message' => 'Pizza not found',
                'id' =>  $id,
            ]));

            return $this->getResponse()->setHttpResponseCode(404);
        }

        $pizzaIngredientTable = new Application_Model_DbTable_PizzaIngredient();
        $pizzaIngredients = $pizzaIngredientTable->getPizzaIngredients($id);

        $response = $pizza->toArray();
        $response['ingredients'] = $pizzaIngredients;

        $this->getResponse()->setBody(json_encode($response));
        $this->getResponse()->setHttpResponseCode(200);
    }

    public function postAction()
    {
        $pizzaForm = new Application_Form_Pizza();

        if ($pizzaForm->isValid($this->getRequest()->getParams())) {
            $formValues = $pizzaForm->getValues();

            $pizzasTable = new Application_Model_DbTable_Pizzas();
            $pizza = $pizzasTable->createRow();
            $pizza->name = $formValues['name'];
            $pizza->price = $formValues['price'];
            $id = $pizza->save();

            $response = [
                'status' => 'success',
                'message' => 'Pizza created',
                'id' => $id,
            ];
            $this->getResponse()->setHttpResponseCode(201);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Pizza not created',
                'errors' => $pizzaForm->getErrors(),
            ];
            $this->getResponse()->setHttpResponseCode(400);
        }

        $this->getResponse()->setBody(json_encode($response));

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
            $this->getResponse()->setBody(json_encode([
                'status' => 'error',
                'message' => 'Pizza not found',
                'id' =>  $id,
            ]));

            return $this->getResponse()->setHttpResponseCode(404);
        }

        $pizzaForm = new Application_Form_Pizza();

        if ($pizzaForm->isValid($this->getRequest()->getParams())) {
            $formValues = $pizzaForm->getValues();

            if (!empty($formValues['name'])) {
                $pizza->name = $formValues['name'];
            }
            if (!empty($formValues['price'])) {
                $pizza->price = $formValues['price'];
            }
            $id = $pizza->save();

            $response = [
                'status' => 'success',
                'message' => 'Pizza updated',
                'id' => $id,
            ];
            $this->getResponse()->setHttpResponseCode(200);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Pizza not updated',
                'errors' => $pizzaForm->getErrors(),
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
        $pizza = $pizzasTable->fetchRow('id = ' . $id);

        if (!isset($pizza)) {
            $this->getResponse()->setBody(json_encode([
                'status' => 'error',
                'message' => 'Pizza not found',
                'id' =>  $id,
            ]));

            return $this->getResponse()->setHttpResponseCode(404);
        }

        $pizzasTable->delete(['id = ' . $id]);

        $pizzaIngredientsTable = new Application_Model_DbTable_PizzaIngredient();
        $pizzaIngredientsTable->delete(['pizza_id = ' . $id]);

        $response = [
            'status' => 'success',
            'message' => 'Pizza deleted',
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
