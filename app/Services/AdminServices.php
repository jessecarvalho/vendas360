<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Seller;
use Illuminate\Support\Facades\Mail;

class AdminServices
{
    public function generateReportForAllSellers(): void
    {
        $sellers = Seller::all();
        foreach ($sellers as $seller) {
            $this->generateReport($seller);
        }
    }

    public function generateReportEmailForAdmin($user) : void
    {

        $sellers = Seller::all();
        $body = "Relatório de vendas: \n";
        foreach ($sellers as $seller) {
            $body .= "Vendedor: " . $seller->name . "\n";
            $sales = $seller->sales()->whereDate('date', now())->get();
            foreach ($sales as $sale) {
                $body .= "Valor: " . $sale->value . " - Data: " . $sale->date . "\n";
            }
        }

        $this->sendEmail($user, $body);
    }

    public function generateReport(mixed $seller): void
    {
        $email = $seller->email;
        $name = $seller->name;
        $subject = "Relatório de vendas";
        $body = "Olá, " . $name . ". Segue seu relatório de vendas: ";
        $sales = $seller->sales()->whereDate('date', now())->get();
        foreach ($sales as $sale) {
            $body .= "Valor: " . $sale->value . " - Comissão" . $this->generateCommissionForSeller($sale->value) . " - Data: " . $sale->date . "\n" ;
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

    private function generateCommissionForSeller($saleValue): float
    {
        return $saleValue * 0.085;
    }

    private function sendEmail($user, $body): void
    {
        Mail::raw($body, function ($message) use ($user) {
            $message->to($user->email, 'Admin');
            $message->subject('Relatório de vendas');
        });
    }
}
