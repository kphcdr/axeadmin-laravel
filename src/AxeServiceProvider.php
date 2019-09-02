<?php

namespace Axe;

use Axe\Console\InstallAxeCommand;
use Axe\Console\ResetPasswordCommand;
use Axe\Http\Middleware\AxeAuthMiddleware;
use Axe\Http\Middleware\AxeOperationLogMiddleware;
use Axe\Http\Middleware\AxeRbacMiddleware;
use Illuminate\Console\Application;
use Illuminate\Console\Application as Artisan;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class AxeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPublishing();
        $this->registerMiddleware();

        $this->loadRoutesFrom(base_path("routes/axe.php"));
    }

    /**
     * Register publish resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . "/../config" => config_path()], "axe-config");
            $this->publishes([__DIR__ . "/../database/migrations" => database_path("migrations")], "axe-migrations");
            $this->publishes([__DIR__ . "/../resources/assets/dist" => public_path()], "axe-resource");
            $this->publishes([__DIR__ . "/../resources/views" => resource_path("views/axe")], "axe-views");
        }

    }

    /**
     * register Middleware
     *
     * @return void
     */
    public function registerMiddleware()
    {

        app(Router::class)->aliasMiddleware("axe.auth", AxeAuthMiddleware::class);
        app(Router::class)->aliasMiddleware("axe.rbac", AxeRbacMiddleware::class);
        app(Router::class)->aliasMiddleware("axe.operation_log", AxeOperationLogMiddleware::class);
        app(Router::class)->middlewareGroup("axe", [
            "axe.auth",
            "axe.rbac",
            "axe.operation_log"
        ]);

    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . "/../config/axe.php", "axe");
        $this->registerCommand();
    }

    protected function registerCommand()
    {
        Artisan::starting(function (Application $artisan) {
            $artisan->resolveCommands([
                ResetPasswordCommand::class,
                InstallAxeCommand::class
            ]);
        });
    }
}