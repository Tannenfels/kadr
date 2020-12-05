<?php

namespace App\Console\Commands;

use App\Classes\CommonConstants;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:import';

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
            $legacyArticles = DB::table('wm11585_25data.sed_pages')->select()->get();

            foreach ($legacyArticles as $legacyArticle) {
                DB::table('articles')->insert(
                    [
                        'id' => $legacyArticle->page_id,
                        'title' => $legacyArticle->page_title,
                        'user_id' => $legacyArticle->page_authorid,
                        'author_ip' => $legacyArticle->page_authorip,
                        'text' => $legacyArticle->page_text,
                        'created_at' => Carbon::createFromTimestamp($legacyArticle->page_date, CommonConstants::TIMEZONE_TEXT)->toDateTimeString()
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
