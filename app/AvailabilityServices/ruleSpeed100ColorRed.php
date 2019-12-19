<?php


namespace App\AvailabilityServices;


use App\AvailabilityServices\Provider\RuleServiceProvider;

class ruleSpeed100ColorRed extends RuleServiceProvider
{

    public function checkSpeedLessThan100()
    {
        $this->setRule("Check Speed Less Than 100");
        $this->queryBuilder->where('speed', '<', 100);
    }

    public function checkColorRed()
    {
        $this->setRule('Check Color not red');
        $this->queryBuilder->where('color', '!=', 'red');
    }

}
