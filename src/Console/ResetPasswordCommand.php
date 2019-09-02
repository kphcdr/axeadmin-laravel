<?php

namespace Axe\Console;

use Axe\Models\Admin;
use Illuminate\Console\Command;

class ResetPasswordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'axe:reset-password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reset-password';

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
     * @return null
     */
    public function handle()
    {
        $name = $this->ask("please input your admin name?");

        $admin = Admin::whereName($name)->first();
        if (is_null($admin)) {
            $this->error("not found {$name}");
            return;
        }

        $password = $this->ask("please input new password");

        $admin->password = $password;
        $admin->save();

        $this->info("reset password success!");
    }
}
