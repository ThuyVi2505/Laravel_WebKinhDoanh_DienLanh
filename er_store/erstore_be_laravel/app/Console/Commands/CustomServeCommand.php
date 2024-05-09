<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Console\ServeCommand;
use Symfony\Component\Console\Input\InputOption;

class CustomServeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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
        return Command::SUCCESS;
    }
    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['host', null, InputOption::VALUE_OPTIONAL, 'Host đang chạy là:', env('SERVER_HOST')],//default 127.0.0.1
            ['port', null, InputOption::VALUE_OPTIONAL, 'Port là:', env('SERVER_PORT')],
        ];
    }
    public function start()
    {
        $this->line("Server đang chạy với url: [{$this->host()}]");

        parent::start();
    }
}
