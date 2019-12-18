<?php


namespace App\AvailabilityServices;


use Illuminate\Database\Eloquent\Builder;

class Price implements AvailableServiceInterface
{
    /**
     * Define property for applying the rule
     *
     * @return string
     */
    public function property() : string
    {
        return 'price';
    }

    /**
     * @return string
     */
    public function rule(): string
    {
        return  $this->property()." must be less than 500";
    }

    /**
     * Apply Filter Rule
     *
     * @param Builder $builder
     * @return Builder
     */
    public function filter(Builder $builder): Builder
    {
        return $builder->where($this->property(), '<', 500);
    }
}
