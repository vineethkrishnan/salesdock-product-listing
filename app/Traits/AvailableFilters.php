<?php


namespace App\Traits;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait AvailableFilters
{

    /**
     * Instead of manually adding Available Service to register
     * auto detect available services
     */
    private function filters(): array
    {
        $filters = [];
        foreach (File::files(app_path('AvailabilityServices')) as $filter) {
            if (stripos($filter->getFilename(), 'Interface') == false) {
                $filters[] = "\App\AvailabilityServices\\" . Str::before($filter->getFilename(), '.');
            }
        }
        return $filters;
    }
}
