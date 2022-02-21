<?php

class Application_Views_Helpers_FormatPrice
    extends Zend_View_Helper_Abstract
{
    /**
     * @description decimal price is given as string, possibly with decimal point. output is always # ###.00 with EUR symbol
     * @param string $decimalPrice
     * @return string
     */
    public function formatPrice($decimalPrice)
    {
        $floatPrice = floatval($decimalPrice);
        $formatted = number_format($floatPrice, 2 , "." , " ") . ' €';

        return $formatted;
    }
}
