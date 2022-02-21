<?php

class Application_Model_DbTable_Ingredients extends Zend_Db_Table_Abstract
{
    protected $_name = 'ingredient';
    
    /**
     * @description returns ingredients of selected pizza in array form suitable for form select field
     * @param int $pizzaId
     */
    public function getSelectData()
    {
        $select = $this->select();
        $data = $select->getAdapter()->query($select)->fetchAll();

        $result = [];
        foreach($data as $item){
            $result[$item['id']] = $item['name'] . '(' . $item['cost'] . '€)';
        }

        return $result;
    }
}
