<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;

class BaseImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'base:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $commandsArray = [
        'roles:create',
        'users:import',
        'articles:import',
        'comments:import',
    ];

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
     * @return void
     */
    public function handle()
    {
        foreach ($this->commandsArray as $command) {
            try {
                    $this->call($command);
                } catch (Exception $exception) {
                    $this->error('Ошибка при выполнении команды ' . $this->signature . "\n" .
                        $exception->getMessage());
                    die();
                }
        }
    }
}
