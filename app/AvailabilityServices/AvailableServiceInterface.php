<?php

namespace App\AvailabilityServices;

use Illuminate\Database\Eloquent\Builder;

interface AvailableServiceInterface
{

    public function property() : string;

    public function rule() : string;

    public function filter(Builder $builder) : Builder;


}
