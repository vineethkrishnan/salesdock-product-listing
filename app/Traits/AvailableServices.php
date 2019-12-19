<?php


namespace App\Traits;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait AvailableServices
{

    /**
     * Instead of manually adding Available Service to register
     * auto detect available services
     */
    private function getServices(): array
    {
        $filters = [];
        foreach (File::files(app_path('AvailabilityServices')) as $filter) {
            $filters[] = "\App\AvailabilityServices\\" . Str::before($filter->getFilename(), '.');
        }
        return $filters;
    }
}
