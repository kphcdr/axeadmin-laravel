<?php

use Laravel\BrowserKitTesting\TestCase as BaseCase;

class TestCase extends BaseCase
{
    protected $baseUrl = 'http://localhost:8000';

    public function createApplication()
    {
        $app = require __DIR__.'/../vendor/laravel/laravel/bootstrap/app.php';
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
        $app->register(\Axe\AxeServiceProvider::class);

        return $app;
    }

    public function setUp()
    {
        parent::setUp();

        $this->app['config']->set('database.default', 'mysql');
        $this->app['config']->set('database.connections.mysql.host', env('DB_HOST'));
        $this->app['config']->set('database.connections.mysql.database', env('DB_DATABASE'));
        $this->app['config']->set('database.connections.mysql.username', env('DB_USERNAME'));
        $this->app['config']->set('database.connections.mysql.password', env('DB_PASSWORD'));
        $this->app['config']->set('app.key', env('APP_KEY'));

        $this->artisan('axe:install');
    }

    public function tearDown()
    {
        $this->artisan('migrate:rollback');

        \Illuminate\Support\Facades\DB::select("delete from `migrations` where `migration` = '2019_08_08_000000_create_axe_admin_table'");

        parent::tearDown();
    }
}
