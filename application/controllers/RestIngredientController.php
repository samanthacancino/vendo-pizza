<?php

/**
 * @category Neo
 * @package ...
 * @copyright Vendo Services, GmbH
 */
class RestIngredientController extends Zend_Rest_Controller
{
    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout()->disableLayout();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
    }

    /**
     * use: http://localhost:8133/rest-ingredient
     *
     * @throws Zend_Controller_Response_Exception
     */
    public function indexAction()
    {
        $table = new Application_Model_DbTable_Ingredients();
        $result = $table->select()->where('1=1')->query()->fetchAll();

        $this->getResponse()->setBody(json_encode($result));
        $this->getResponse()->setHttpResponseCode(200);
    }

    /**
     * use: http://localhost:8133/rest-ingredient/get/?id=1
     *
     * @throws Zend_Controller_Response_Exception
     */
    public function getAction()
    {
        $id = (int)$this->getRequest()->getParam('id');

        $table = new Application_Model_DbTable_Ingredients();
        $result = $table->select()->where('id = ?', $id)->query()->fetchAll();

        $this->getResponse()->setBody(json_encode($result));
        $this->getResponse()->setHttpResponseCode(200);
    }

    /**
     * use: http://localhost:8133/rest-ingredient/post/?name=other&cost=2.5
     *
     * @throws Zend_Controller_Response_Exception
     * @throws Zend_Form_Exception
     */
    public function postAction()
    {
        $table = new Application_Model_DbTable_Ingredients();
        $form = new Application_Form_Ingredient($table);
        if ($form->isValid($this->getRequest()->getQuery())) {

            $ingredient = $table->createRow([
                'name' => $form->getValue('name'),
                'cost' => $form->getValue('cost'),
            ]);
            $id = $ingredient->save();

            $this->getResponse()->setBody(json_encode([
                'status' => 'success',
                'message' => 'Ingredient was created',
                'id' =>  $id,
            ]));

            $this->getResponse()->setHttpResponseCode(201);
        } else {
            $this->getResponse()->setBody(json_encode([
                'status' => 'error',
                'message' => 'Ingredient not created',
                'errors' => $form->getErrors(),
            ]));
            $this->getResponse()->setHttpResponseCode(400);
        }
    }

    /**
     * use: http://localhost:8133/rest-ingredient/put/?id=3&name=other&cost=2.51
     *
     * @throws Zend_Controller_Response_Exception
     * @throws Zend_Form_Exception
     */
    public function putAction()
    {
        $id = (int)$this->getRequest()->getParam('id');

        $table = new Application_Model_DbTable_Ingredients();
        $form = new Application_Form_Ingredient($table);
        if ($form->isValid($this->getRequest()->getQuery())) {

            $ingredient = $table->fetchRow($table->getAdapter()->quoteInto('id = ?',  $id));
            if(!isset($ingredient)){
                $this->getResponse()->setBody(json_encode([
                    'status' => 'error',
                    'message' => 'Ingredient not found',
                    'id' =>  $id,
                ]));

                return $this->getResponse()->setHttpResponseCode(404);
            }

            $ingredient->setFromArray([
                'name' => $form->getValue('name'),
                'cost' => $form->getValue('cost'),
            ]);
            $ingredient->save();

            $this->getResponse()->setBody(json_encode([
                'status' => 'success',
                'message' => 'Ingredient was updated',
                'id' => $id,
            ]));
            $this->getResponse()->setHttpResponseCode(200);
        } else {
            $this->getResponse()->setBody(json_encode([
                'status' => 'error',
                'message' => 'Ingredient not created',
                'errors' => $form->getErrors(),
            ]));
            $this->getResponse()->setHttpResponseCode(400);
        }
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');

        if (!isset($id)) {
            throw new Exception('ID not specified');
        }

        $ingredientsTable = new Application_Model_DbTable_Ingredients();
        $ingredient = $ingredientsTable->fetchRow($ingredientsTable->select()->where('id = ?', (int)$id));

        if (!isset($ingredient)) {
            $this->getResponse()->setBody(json_encode([
                'status' => 'error',
                'message' => 'Ingredient not found',
                'id' =>  $id,
            ]));

            return $this->getResponse()->setHttpResponseCode(404);
        }

        $ingredientsTable->delete(['id = ' . (int)$id]);

        $response = [
            'status' => 'success',
            'message' => 'Ingredient deleted',
            'id' => $id,
        ];

        $this->getResponse()->setBody(json_encode($response));
        $this->getResponse()->setHttpResponseCode(200);
    }

    public function headAction()
    {
        // you should add your own logic here to check for cache headers from the request
        $this->getResponse()->setBody(null);
    }

    public function optionsAction()
    {
        $this->getResponse()->setBody(null);
        $this->getResponse()->setHeader('Allow', 'OPTIONS, HEAD, INDEX, GET, POST, PUT, DELETE');
    }
}
