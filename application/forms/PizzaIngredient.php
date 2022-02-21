<?php

class Application_Form_PizzaIngredient extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');

        $ingredientsTable = new Application_Model_DbTable_Ingredients();

        $this->addElement(new Zend_Form_Element_Select('ingredient_id', [
            'label'      => 'Select ingredient',
            'required'   => true,
            'multiOptions' => $ingredientsTable->getSelectData(),
        ]));

        $this->addElement('text', 'quantity', [
            'label'      => 'Quantity (g)',
            'required'   => true,
            'validators' => [
                new Zend_Validate_Between(['min' => 1, 'max' => 1000]),
            ],
            'value' => 1,
        ]);
    }
}
