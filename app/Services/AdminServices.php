<?php

namespace App\Services;

use App\Models\Seller;
use Illuminate\Support\Facades\Mail;

class AdminServices
{
    public function generateReportForAllSellers(): void
    {
        $sellers = Seller::all();
        foreach ($sellers as $seller) {
            $this->generateReportForSeller($seller);
        }
    }
    public function generateReportForAdmin($user) : void
    {
        $sellers = Seller::all();
        $totalSalesValue = 0;
        foreach ($sellers as $seller) {
            $sales = $seller->sales()->whereDate('date', now())->get();
            $totalSalesValue += $this->calculateTotalValue($sales);
        }

        $body = "Olá, " . $user->name . ". Segue o relatório de vendas do dia: \n";
        $body .= "Valor total das vendas: " . $totalSalesValue . "\n";

        $this->sendReportByEmail($user->email, $user->name, "Relatório de vendas do dia", $body);
    }

    public function generateReportForSeller(mixed $seller): void
    {
        $subject = "Relatório de vendas do dia";
        $sales = $seller->sales()->whereDate('date', now())->get();
        $totalSales = $this->calculateTotalSales($sales);
        $totalValue = $this->calculateTotalValue($sales);
        $totalCommission = $this->calculateTotalCommission($sales);
        $body = "Olá, " . $seller->name . ". Segue seu relatório de vendas do dia: \n";
        $body .= "Quantidade de vendas: " . $totalSales . "\n";
        $body .= "Valor total das vendas: " . $totalValue . "\n";
        $body .= "Valor total das comissões: " . $totalCommission . "\n";

        $this->sendReportByEmail($seller->email, $seller->name, $subject, $body);
    }

    private function sendReportByEmail($email, $name, $subject, $body): void
    {
        Mail::raw($body, function ($message) use ($email, $name, $subject) {
            $message->to($email, $name);
            $message->subject($subject);
        });
    }

    private function calculateTotalCommission($sales): float
    {
        return $sales->sum('value') * 0.085;
    }

    private function calculateTotalValue($sales): float
    {
        return $sales->sum('value');
    }

    private function calculateTotalSales($sales): int
    {
        return $sales->count();
    }

}
