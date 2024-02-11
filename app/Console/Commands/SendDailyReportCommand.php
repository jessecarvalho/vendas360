<?php

namespace App\Console\Commands;

use App\Services\AdminServices;
use Illuminate\Console\Command;

class SendDailyReportCommand extends Command
{

    protected AdminServices $adminServices;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-daily-report-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily sales report email to the admin and the sales team.';

    /**
     * Execute the console command.
     */
    public function handle(AdminServices $adminServices)
    {
        $this->adminServices = $adminServices;
        $this->info('Sending daily sales report email to the admin and the sales team.');
        $this->adminServices->generateReportForAdmin();
        $this->adminServices->generateReportForAllSellers();
        $this->info('Daily sales report email sent to the admin and the sales team.');
    }
}
