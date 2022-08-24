<?php

namespace App\Console\Commands;

use Illuminate\Console\Application;
use Illuminate\Console\Command;
use Illuminate\Console\Parser;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;

class RunThree extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "tenants:runthree {commandname : Complete command's name and options.}
                            {--tenants=* : The tenant(s) to run the command for. Default: all}";

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
        dd($this->option('tenants'));
        return 0;
    }
}
