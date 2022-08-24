<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class RunTwo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "tenants:runtwo {commandname : Complete command's name and options.}
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

        tenancy()->runForMultiple($this->option('tenants'), function ($tenant) {
            $this->line("Tenant: {$tenant->getTenantKey()}");


            $completeCommand = explode(" ", $this->argument('commandname'));
            $commandName = array_shift($completeCommand);

            $options = [];
            $arguments = [];
            foreach ($completeCommand as $option) {
                if (Str::startsWith($option, '--')) {
                    // this is an option
                    if (Str::contains($option, '=')) {
                        // convert value options to key-value array eg --sort=name ["--sort" => "name"]
                        $explodedOption = explode("=", $option);
                        $options[$explodedOption[0]] = $explodedOption[1];
                    } else {
                        // convert options without values to true eg --except-vendor to --except-vendor=true
                        // because specifying --except-vendor turns it into true
                        $options[$option] = true;
                    }
                } else {
                    $arguments[] = $option;
                }
            }
            $this->call($commandName, array_merge($arguments, $options));
            $options = array_filter($completeCommand, fn($option) => Str::startsWith($option, '--'));
            $arguments = array_filter($completeCommand, fn($option) => Str::words($option, '--'));

            dd($completeCommand);
            $newOptions = [];
            foreach ($options as $option) {
                if (Str::contains($option, '=')) {
                    // convert value options to key-value array eg --sort=name ["--sort" => "name"]
                    $explodedOption = explode("=", $option);
                    $newOptions[$explodedOption[0]] = $explodedOption[1];
                } else {
                    // convert options without values to true eg --except-vendor to --except-vendor=true
                    // because specifying --except-vendor turns it into true
                    $newOptions[$option] = true;
                }
            }

//            dd($options);

//            dd($commandName);
            $this->call($commandName, $newOptions);
//            $this->call($this->argument('commandname'));
//            Artisan::call($this->argument('commandname'));
//            $this->comment('Command output:');
//            $this->info(Artisan::output());
        });

        return 0;
    }
}
