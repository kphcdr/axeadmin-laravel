<?php

namespace Axe\Console;

use Axe\AxeServiceProvider;
use Axe\Seeder\AxeAdminSeeder;
use Illuminate\Console\Command;

class InstallAxeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'axe:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('you will install axe-admin');
        $this->call('vendor:publish', ['--provider' => AxeServiceProvider::class]);
        $this->call('migrate');
        $this->call('db:seed', ['--class' => AxeAdminSeeder::class]);
    }
}
