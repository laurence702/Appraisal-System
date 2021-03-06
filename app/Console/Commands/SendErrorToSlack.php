<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Notifications\SlackNotifier;
use Modules\Employee\Models\Employee;

class SendErrorToSlack extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:slack';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this  notifies slack of error in application';

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
     * @return int
     */
    public function handle()
    {
        //second param is the email address u used to create the slack api app
        Employee::where('email', 'your-slacl-email-address-here')->first()->notify(new SlackNotifier());
    }
}
