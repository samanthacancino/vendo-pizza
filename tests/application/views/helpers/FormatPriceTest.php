<?php

require APPLICATION_PATH . '/views/helpers/FormatPrice.php';

class FormatPriceTest extends \PHPUnit\Framework\TestCase
{
    public function testFormatNullReturnsZeroPointZeroZeroEur()
    {
        $expectedResult = '0.00 €';
        $result = (new Application_Views_Helpers_FormatPrice())->formatPrice(null);
        $this->assertEquals($expectedResult, $result);
    }

    public function testFormatNotNumberReturnsZeroPointZeroZeroEur()
    {
        $expectedResult = '0.00 €';
        $result = (new Application_Views_Helpers_FormatPrice())->formatPrice("not number");
        $this->assertEquals($expectedResult, $result);
    }

    public function testFormatIntegerReturnsNumberPointZeroZeroEur()
    {
        $expectedResult = '12.00 €';
        $result = (new Application_Views_Helpers_FormatPrice())->formatPrice(12);
        $this->assertEquals($expectedResult, $result);
    }

    public function testFormatDoubleReturnsNumberPointDigitDigitEur()
    {
        $expectedResult = '12.21 €';
        $result = (new Application_Views_Helpers_FormatPrice())->formatPrice(12.21001);
        $this->assertEquals($expectedResult, $result);
    }

    public function testFormatBigNumberReturnsFormattedEur()
    {
        $expectedResult = '12 345 678 910.21 €';
        $result = (new Application_Views_Helpers_FormatPrice())->formatPrice('12345678910.2112345');
        $this->assertEquals($expectedResult, $result);
    }
    
    public function testFormatBigNegativeNumberReturnsFormattedEur()
    {
        $expectedResult = '-12 345 678 910.21 €';
        $result = (new Application_Views_Helpers_FormatPrice())->formatPrice('-12345678910.2112345');
        $this->assertEquals($expectedResult, $result);
    }    
}
