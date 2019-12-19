<?php


namespace App\AvailabilityServices\Provider;


use App\AvailabilityServices\Contracts\AvailabilityServiceInterface;
use Illuminate\Database\Eloquent\Builder;

abstract class RuleServiceProvider implements AvailabilityServiceInterface
{
    protected $rules = [];

    protected $queryBuilder;

    public function setRule(string $rule)
    {
        $this->rules[] = $rule;
    }

    public function getRules(): array
    {
        return $this->rules;
    }

    public function setQueryBuilder(Builder $queryBuilder): void
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function getQueryBuilder(): Builder
    {
        return $this->queryBuilder;
    }

    public function filter(Builder $builder)
    {
        $this->setQueryBuilder($builder);

        /**
         * Get class information from reflection class
         */
        try {
            $reflectionsClasses = new \ReflectionClass($this);
            foreach ($reflectionsClasses->getMethods() as $method) {

                /** We do not need to look for contracts and provider, just available services */
                if (strpos($method->class,'Contracts') == false && strpos($method->class,'Provider') == false) {
                    $this->{$method->getName()}();
                }
            }
        } catch (\ReflectionException $e) {}

    }

}
