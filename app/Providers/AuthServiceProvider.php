<?php

namespace App\Providers;

use App\Policies\PostPolicy;
use App\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-post', 'App\Policies\PostPolicy@edit');
        Gate::define('update-post', 'App\Policies\PostPolicy@update');
        Gate::define('delete-post', 'App\Policies\PostPolicy@delete');
    }
}
