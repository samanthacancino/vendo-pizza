<?php

class Application_Form_Pizza extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');

        $this->addElement('text', 'name', [
            'label'      => 'Name of the pizza:',
            'required'   => false,
            'filters'    => ['StringTrim'],
            'validators' => []
        ]);

        $this->addElement('text', 'price', [
            'label'      => 'Price:',
            'required'   => false,
            'validators' => [
                new Zend_Validate_Between(['min' => 0.01, 'max' => 1000.0]),
            ],
        ]);
    }
}
