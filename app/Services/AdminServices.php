<?php

namespace App\Services;

use App\Mail\AdminReportMail;
use App\Mail\SellerReportMail;
use App\Models\Admin;
use App\Models\Sale;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AdminServices
{

    public function update($data): bool
    {
        $admin = Admin::first();

        if (!$admin) {
            $admin = new Admin();
        }

        $admin->name = $data['name'];
        $admin->email = $data['email'];
        $admin->commission = $data['commission'];
        return $admin->save();

    }
    public function generateReportForAllSellers(): void
    {
        $sellers = Seller::all();
        foreach ($sellers as $seller) {
            $this->generateReportForSeller($seller);
        }
    }
    public function generateReportForAdmin() : void
    {
        $users = User::all();
        if ($users->isEmpty()) {
            return;
        }

        $totalSalesValue = $this->getAllSalesForToday();
        $subject = "Relatório de vendas do dia";
        foreach ($users as $user) {
            $data = [
                'totalSales' => $totalSalesValue,
            ];
            $this->sendReportByEmail($user->email, $user->name, $subject, $data, "admin");
        }
    }

    public function generateReportForSeller(mixed $seller): void
    {
        $subject = "Relatório de vendas do dia";
        $sales = $seller->sales()->whereDate('date', now())->get();
        $totalSales = $this->calculateTotalSales($sales);
        $totalValue = $this->calculateTotalValue($sales);
        $totalCommission = $this->calculateTotalCommission($sales);

        $data = [
            'totalSales' => $totalSales,
            'totalValue' => $totalValue,
            'totalCommission' => $totalCommission,
        ];

        $this->sendReportByEmail($seller->email, $seller->name, $subject, $data, "seller");
    }

    private function sendReportByEmail($email, $name, $subject, $data, $role): void
    {
        if ($role == "admin"){
            $reportEmail = new AdminReportMail($subject, $data);
        } else if ($role == "seller"){
            $reportEmail = new SellerReportMail($subject, $data);
        }

        if ($role) Mail::to($email, $name)->send($reportEmail);

    }

    private function calculateTotalCommission($sales): float
    {
        return $sales->sum('commission');
    }

    private function calculateTotalValue($sales): float
    {
        return $sales->sum('value');
    }

    private function calculateTotalSales($sales): int
    {
        return $sales->count();
    }

    private function getAllSalesForToday()
    {
        return Sale::whereDate('date', now())->sum('value');
    }

}
