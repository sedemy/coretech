<?php

namespace App\Services\TaxTypes;

use App\Interfaces\TaxCalculatorInterface;

class TaxTypeService
{
    public TaxCalculatorInterface $taxCalculator;

    public function __construct(TaxCalculatorInterface $taxCalculator){
        $this->taxCalculator = $taxCalculator;
    }

    public function calcTax(float $amount): float
    {
        return $this->taxCalculator->calculate($amount);
    }
}