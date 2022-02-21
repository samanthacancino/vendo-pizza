<?php
/**
 * @category
 * @package
 * @copyright
 */

require '/app/vendor/autoload.php';

class Application_Form_IngredientTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider dataProvider
     * @param $values
     * @param $expectedIsValid
     * @param $expectedValidValues
     * @throws \Zend_Form_Exception
     */
    public function testForm($values, $expectedIsValid, $expectedValidValues)
    {
        $form = new Application_Form_Ingredient();

        $actualIsValid = $form->isValid($values);

        $this->assertSame($expectedIsValid, $actualIsValid);

        $actualValidValues = $form->getValidValues($values);

        if (!isset($expectedValidValues)) {
            $expectedValidValues = $values;
        }

        $this->assertSame($expectedValidValues, $actualValidValues);
    }

    public function dataProvider()
    {
        return [
            [
                [
                    'name' => 'Mozzarella',
                    'cost' => 2.80,
                ],
                true,
                null,
            ],
            [
                [
                    'name' => '',
                    'cost' => 2.80,
                ],
                false,
                [
                    'cost' => 2.80,
                ],
            ],
            [
                [
                    'name' => 'Cheap ingredient',
                    'cost' => 0.0,
                ],
                false, // Ingredients can be cheap but never free
                [
                    'name' => 'Cheap ingredient',
                ],
            ],
        ];
    }
}
