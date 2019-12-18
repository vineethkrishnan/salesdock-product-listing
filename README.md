
# Salesdock Product Listing

### Introduction
Application that automatically detect added service filter and apply it to the eloquent result.

### Installation

1. Clone Git Repository
       `$ git clone git@gitlab.com:vineethkrishnan/salesdock-products.git `
2. Navigate to project root 
       `$ cd  salesdock-products`
3. Run 
       `composer install`
4. Copy .env.example to .env and fill-out the database details
5. After completing application installation run
       `php artisan key:generate`
6. Run migration with --seed flag, it will seed the test data
        `php artisan migrate --seed`
7. Create a test server by running
        `php artisan serve`

Now got to API End point http://localhost:8000/api/products to view the product listing

### How to add new Availability Service
Suppose we want to add a new service that filter the product name starts with `sales`
> Go to `app/AvailabilityServices`
* Create a new service file `Name.php` that implements `AvailableServiceInterface` Contract

```php

<?php
namespace App\AvailabilityServices;


use Illuminate\Database\Eloquent\Builder;

class Name implements AvailableServiceInterface
{
    /**
     * Define property for applying the rule
     *
     * @return string
     */
    public function property() : string
    {
        return 'name';
    }

    /**
     * @return string
     */
    public function rule(): string
    {
        return  $this->property()." must start with sales";
    }

    /**
     * Apply Filter Rule
     *
     * @param Builder $builder
     * @return Builder
     */
    public function filter(Builder $builder) : Builder
    {
        return $builder->where($this->property(), 'LIKE', 'sales%');
    }
}
```

#### Code Anatomy
* `public function property()` defines the property on which we want to apply the filter rule
* `public function rule()` return the rule applied by this service.
* `public function filter(Builder $builder)` accept the query builder and apply the rule and return the modified query builder.


> Now the product listing on api end point has been modified with the new service rule

*Sample Response :*

```json
{
    "applied_service_rules": [
        {
            "service": "\\App\\AvailabilityServices\\Name",
            "rule": "name must start with sales"
        }
    ],
    "data": [
        {
            "id": 5,
            "name": "salesdock",
            "color": "yellow",
            "speed": 80,
            "price": 72.02,
            "created_at": "2019-12-18 14:58:33",
            "updated_at": "2019-12-18 14:58:33"
        }
]
}
```
