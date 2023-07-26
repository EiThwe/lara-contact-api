<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Contact;
use App\Models\SearchRecord;
use App\Policies\ContactPolicy;
use App\Policies\SearchRecordPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Contact::class => ContactPolicy::class,
        SearchRecord::class => SearchRecordPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
