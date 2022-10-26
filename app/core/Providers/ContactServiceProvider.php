<?php

namespace App\Providers;

use Domain\Aggregates\Contact;
use Domain\Aggregates\Contracts\ContactAggregateInterface;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Repositories\ContactRepository;
use Domain\Repositories\ContactRepositoryInterface;
use Domain\Services\Contact\CreateContact;
use Presentation\Contracts\contact\CreateContactInterface;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ContactAggregateInterface::class, Contact::class);
        $this->app->bind(CreateContactInterface::class, CreateContact::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
