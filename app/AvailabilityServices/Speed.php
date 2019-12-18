<?php


namespace App\AvailabilityServices;


use Illuminate\Database\Eloquent\Builder;

class Speed implements AvailableServiceInterface
{
    /**
     * Define property for applying the rule
     *
     * @return string
     */
    public function property() : string
    {
        return 'speed';
    }

    /**
     * @return string
     */
    public function rule(): string
    {
        return  $this->property()." must be greater than 10";
    }

    /**
     * Apply Filter Rule
     *
     * @param Builder $builder
     * @return Builder
     */
    public function filter(Builder $builder): Builder
    {
        return $builder->where($this->property(), '>', 10);
    }
}
