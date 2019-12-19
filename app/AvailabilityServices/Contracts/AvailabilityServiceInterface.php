<?php

namespace App\AvailabilityServices\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface AvailabilityServiceInterface
{

    public function setRule(string $rule);

    public function getRules() : array;

    public function filter(Builder $builder);

    public function setQueryBuilder(Builder $builder);

    public function getQueryBuilder() : Builder;


}
