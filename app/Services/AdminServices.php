<?php

namespace App\Services;

use App\Models\Seller;
use Illuminate\Support\Facades\Mail;

class AdminServicescalculateTotalSales
{
    public function generateReportForAllSellers(): void
    {
        $sellers = Seller::all();
        foreach ($sellers as $seller) {
            $sales = $seller->sales()->whereDate('date', now())->get();
            $totalSales = $this->calculateTotalSales($sales);
            $totalValue = $this->calculateTotalValue($sales);
            $totalCommission = $this->calculateTotalCommission($sales);

            $body = "Olá, " . $seller->name . ". Segue seu relatório de vendas do dia: \n";
            $body .= "Quantidade de vendas: " . $totalSales . "\n";
            $body .= "Valor total das vendas: " . $totalValue . "\n";
            $body .= "Valor total das comissões: " . $totalCommission . "\n";

            $this->sendReportByEmail($seller->email, $seller->name, "Relatório de vendas do dia", $body);
        }
    }
    public function generateReportEmailForAdmin($user) : void
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

    public function generateReport(mixed $seller): void
    {
        $email = $seller->email;
        $name = $seller->name;
        $subject = "Relatório de vendas";
        $body = "Olá, " . $name . ". Segue seu relatório de vendas: " . "\n";
        $sales = $seller->sales()->whereDate('date', now())->get();
        foreach ($sales as $sale) {
            $body .= "Valor: " . $sale->value . " - Comissão: " . $this->generateCommissionForSeller($sale->value) . " - Data: " . date("d/m/Y", strtotime($sale->date)) . "\n" ;
        }
        $this->sendReportByEmail($email, $name, $subject, $body);
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
