<?php

namespace App\Models;

use App\Traits\AvailableFilters;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use AvailableFilters;

    /**
     * Prepare the model and apply all service rule
     */
    public function getProducts(): array
    {
        $queryBuilder = $this->newQuery();
        $response = [];
        collect($this->filters())->each(function ($service) use ($queryBuilder, &$response) {
            $serviceInstance = app()->make($service);
            $response['applied_service_rules'][] = ['service' => $service, 'rule' => $serviceInstance->rule()];
            $serviceInstance->filter($queryBuilder);
        });
        $response['data'] = $queryBuilder->get();

        return $response;
    }
}
