<?php


namespace App\AvailabilityServices;


use App\AvailabilityServices\Provider\RuleServiceProvider;

class ruleColorWhiteOrYellow extends RuleServiceProvider
{

    public function checkForWhiteColor()
    {
        /** This set rule is optional as we can easily Identify the rule from method name
         *  if we define our member function name as explanatory  like checkForWhiteColor, checkForSpeedLessThan100, checkFOrPriceBetween50And5000 etc.,
         */
        $this->setRule('Color must be white or yellow');
        $this->queryBuilder->where(function($query){
            $query->whereIn('color', ['white', 'yellow']);
        });
    }
}
