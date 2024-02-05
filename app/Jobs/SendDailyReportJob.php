<?php

namespace App\Jobs;

use App\Services\AdminServices;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendDailyReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private AdminServices $adminServices;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->adminServices = new AdminServices();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->adminServices->generateReportForAdmin();
        $this->adminServices->generateReportForAllSellers();

    }
}
