<?php


namespace App\AvailabilityServices;


use App\AvailabilityServices\Provider\RuleServiceProvider;

class rulePriceBetween500And1000AndNameStartWithM extends RuleServiceProvider
{

    public function checkForPriceBetween500And1000()
    {
        $this->setRule('Price Between 500 & 1000');
        $this->queryBuilder->whereBetween('price', [500,1000]);
    }

    public function checkForNameStartsWithM()
    {
        $this->setRule("Name starts with 'm'");
        $this->queryBuilder->where('name', 'LIKE', 'm%');
    }
}
