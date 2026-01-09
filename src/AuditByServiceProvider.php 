<?php

namespace Avi\AuditBy;

use Illuminate\Support\ServiceProvider;
use Avi\AuditBy\Contracts\AuditUserResolver;
use Avi\AuditBy\Resolvers\CompositeResolver;

class AuditByServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/audit-by.php',
            'audit-by'
        );

        $this->app->singleton(
            AuditUserResolver::class,
            CompositeResolver::class
        );
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/audit-by.php' =>
                    config_path('audit-by.php'),
            ], 'audit-by-config');
        }
    }
}
