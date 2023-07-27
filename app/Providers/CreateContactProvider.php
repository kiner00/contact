<?php

namespace App\Providers;

use Contacts\Interface\CreateContactInterface;
use Illuminate\Support\ServiceProvider;
use Contacts\Service\v1\CreateContactService as v1;
use Contacts\Service\v2\CreateContactService as v2;
use Contacts\Service\Prod\CreateContactService as prod;

class CreateContactProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $provider = match(env('FLAG')){
            '1.0' => v1::class,
            '2.0' => v2::class,
            default => prod::class
        };
        
        $this->app->bind(CreateContactInterface::class, $provider);
    }
}
