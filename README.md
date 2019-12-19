
# Salesdock Product Listing

### Introduction
Application that automatically detect added service filter and apply it to the eloquent result.

### Installation

1. Clone Git Repository
       `$ git clone git@github.com:vineethkrishnan/salesdock-product-listing.git `
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
* Create a new service file `myNewServiceRule.php` that extends `App\AvailabilityServices\Provider\RuleServiceProvider` which was implemented with `App\AvailabilityServices\Contracts\AvailabilityServiceInterface`

```php

<?php


namespace App\AvailabilityServices;


use App\AvailabilityServices\Provider\RuleServiceProvider;

class ruleNameMustStartWithSalesAndPriceBelow1000 extends RuleServiceProvider
{

    public function checkForNameStartsWithSales()
    {
        $this->setRule("Product name must starts with 'sales'");
        $this->queryBuilder->where("name", "LIKE", "sales%");
    }

    public function checkForPriceBelow1000()
    {
        $this->setRule('Price must be below 1000');
        $this->queryBuilder->where('price', '<', 1000);
    }

}

```

#### NOTE
* The only thing important here is, we must extend our `ServiceClass` to `RuleServiceProvider`.
* Access modifier for the member function should be `public` or `protected`. Never define member function with `private` access because `RouteServiceProvider` could not access private methods.
* `$this->setRule($rule)` is mandatory at this point but we can auto detect the rule from method name, but we have to restrict other developers to follow RuleService method naming convention to be self explanatory  like checkColorMustBeWhite, checkSpeedLessThan100, checkPriceBetween50And5000 etc.,

> Now the product listing on api end point has been modified with the new service rule

*Sample Response :*

```json
{
    "rules": [
        {
            "service": "\\App\\AvailabilityServices\\ruleColorWhiteOrYellow",
            "rule": [
              "Color must be white or yellow"
            ]
        },
        {
            "service": "\\App\\AvailabilityServices\\rulePriceBetween500And1000AndNameStartWithM",
            "rule": [
                "Price Between 500 & 1000",
                "Name starts with 'lg'"
            ]
        },
        {
            "service": "\\App\\AvailabilityServices\\ruleSpeed100ColorRed",
            "rule": [
                "Check Speed Less Than 100",
                "Check Color not red"
            ]
        }
    ],
    "data": [
        {
            "id": 5,
            "name": "LG Electronics",
            "color": "white",
            "speed": 80,
            "price": 523.43,
            "created_at": "2019-12-18 14:58:33",
            "updated_at": "2019-12-18 14:58:33"
        }
    ]
}
```
