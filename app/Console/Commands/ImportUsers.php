<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        try {
            $legacyUsers = DB::table('wm11585_25data.sed_users')->select()->get();



            //$2y$10$i0US3SQLeJ17lUyvxKIPyuKC6JttVmlH.KVhcm3H7HO5ovIiAeu8y

            foreach ($legacyUsers as $legacyUser) {
                DB::table('users')->insert(
                    [
                        'id' => $legacyUser->user_id,
                        'name' => $legacyUser->user_name,
                        'email' => $legacyUser->user_email,
                        'password' => $legacyUser->user_password,
                        'created_at' => Carbon::createFromTimestamp($legacyUser->user_regdate)->toDateTimeString(),
                        'email_verified_at' => Carbon::now()->toDateTimeString()
                    ]
                );
            }
        } catch (Exception $exception) {
            $this->error('Ошибка при выполнении команды ' . $this->signature . "\n" .
                $exception->getMessage());
            die();
        }
    }
}
