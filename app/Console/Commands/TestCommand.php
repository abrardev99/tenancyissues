<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:command {name} {--a}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $age = $this->ask('What is your age?');
        $password = $this->secret('What is the password?');

        $this->line($this->argument('name') . '('.$age.') ' . $password . ' a' . $this->option('a'));

        return 0;
    }
}
