<?php

class Application_Form_Ingredient extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');

        $this->addElement('text', 'name', [
            'label'      => 'Name of the ingredient:',
            'required'   => true,
            'filters'    => ['StringTrim'],
        ]);

        $this->addElement('text', 'cost', [
            'label'      => 'Cost (EUR/kg):',
            'required'   => true,
             'validators' => [
                new Zend_Validate_Between(['min' => 0.01, 'max' => 1000.0]),
            ],
        ]);

        $this->addElement('submit', 'submit', [
            'ignore' => true,
            'class' => 'btn btn-md btn-primary',
            'label' => 'Save',
        ]);
    }
}
