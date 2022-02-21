<?php

class Application_Model_DbTable_PizzaIngredient extends Zend_Db_Table_Abstract
{
    protected $_name = 'pizza_ingredient';

    /**
     * @description returns ingredients of selected pizza as array with names and cost
     * @param int $pizzaId
     * @return array
     */
    public function getPizzaIngredients(int $pizzaId)
    {
        $select = $this->select()
            ->from(['pi' => 'pizza_ingredient'], ['ingredient_id', 'quantity', 'ingredient.name', 'ingredient.cost'])
            ->joinLeft('ingredient','ingredient.id = ingredient_id')
            ->where('pizza_id = ?', $pizzaId)
            ->setIntegrityCheck(false);
        ;

        $data = $select->getAdapter()->query($select)->fetchAll();

        return $data;
    }
    
    /**
     * @description returns total cost of all ingredients used for selected pizza 
     * @param int $pizzaId
     * @return double
     */
    public function getTotalPizzaCost(int $pizzaId)
    {
        $select = $this->select()
            ->from(['pi' => 'pizza_ingredient'], ['pid' => 'pi.id', 'quantity', 'ingredients.cost'])
            ->joinLeft('ingredient','ingredient.id = ingredient_id')
            ->where('pizza_id = ?', $pizzaId)
            ->order(["pid ASC"])
            ->setIntegrityCheck(false);
        ;

        $data = $select->getAdapter()->query($select)->fetchAll();

        $total = 0.0;
        foreach($data as $item){
            $total += floatval($item['cost']) * floatval($item['quantity'])/1000.0;
        }

        return $total;
    }
}
