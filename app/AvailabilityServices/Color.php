<?php


namespace App\AvailabilityServices;


use Illuminate\Database\Eloquent\Builder;

/**
 * Class Color for checking color of the product
 *
 * @package App\AvailabilityServices
 */
class Color implements AvailableServiceInterface
{
    /**
     * Define property for applying the rule
     *
     * @return string
     */
    public function property() : string
    {
        return 'color';
    }

    /**
     * @return string
     */
    public function rule(): string
    {
        return  $this->property()." should not be black";
    }

    /**
     * Apply Filter Rule
     *
     * @param Builder $builder
     * @return Builder
     */
    public function filter(Builder $builder): Builder
    {
        return $builder->where($this->property(), '!=', 'black');
    }


}
