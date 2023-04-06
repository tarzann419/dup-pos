<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ExpiryNotificationController;

class ExpiryNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expiry:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification for expiring products.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $controller = new ExpiryNotificationController();
        $controller->sendExpiryNotification();
    }
}
