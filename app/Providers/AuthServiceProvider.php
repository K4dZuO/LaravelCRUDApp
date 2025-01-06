<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Turtle;
use App\Policies\TurtlePolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Turtle::class => TurtlePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

    }
}
