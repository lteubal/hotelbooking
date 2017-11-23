<?php

namespace App\Console\Commands;
use Mail;
use Carbon\Carbon;
use App\Mail\SearchLog;

use Illuminate\Console\Command;

class SearchLog20 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Search Log every 20 minutes';

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
      $toemail = config('log.email'); // edit in config file "log"
      $search = \App\Search::where('created_at', '>=', Carbon::now()->subMinutes(20))->get();
      Mail::to($toemail)->send(new SearchLog($search));
    }
}
