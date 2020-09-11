<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImportComments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'comments:import';

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
            $legacyComments = DB::table('wm11585_25data.sed_com')->select()->get();
            $legacyComments->each(function (&$item) {
                $item->com_code = (int)trim($item->com_code, 'p');
            });


            foreach ($legacyComments as $legacyComment) {
                DB::table('comment_threads')->insertOrIgnore(
                    [
                        'id' => $legacyComment->com_id,
                        'article_id' => $legacyComment->com_code,
                        'user_id' => $legacyComment->com_authorid,
                        'author_ip' => $legacyComment->com_authorip,
                        'text' => $legacyComment->com_text,
                        'created_at' => Carbon::createFromTimestamp($legacyComment->com_date)->toDateTimeString()
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
