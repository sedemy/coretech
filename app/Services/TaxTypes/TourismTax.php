<?php

namespace App\Services\TaxTypes;

use App\Interfaces\TaxCalculatorInterface;

class TourismTax implements TaxCalculatorInterface
{
    public function calculate(float $amount): float
    {
        return $amount * 0.05;
    }
}