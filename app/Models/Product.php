<?php

namespace App\Models;

use App\Traits\AvailableServices;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use AvailableServices;

    /**
     * Prepare the model and apply all service rule
     */
    public function getProducts(): array
    {
        $queryBuilder = $this->newQuery();
        $response = [];
        foreach ($this->getServices() as $service){
            $serviceInstance = app()->make($service);
            $serviceInstance->filter($queryBuilder);
            $response['rules'][] = ['service' => $service, 'rule' => $serviceInstance->getRules()];
        }
        $response['data'] = $queryBuilder->get();

        return $response;
    }
}
