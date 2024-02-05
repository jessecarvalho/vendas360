<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use \Illuminate\View\View;
use \Illuminate\Http\RedirectResponse;
use App\Services\AdminServices;


class AdminController extends Controller
{
    private AdminServices $adminServices;

    public function __construct(AdminServices $adminServices)
    {
        $this->adminServices = $adminServices;
    }

    public function index() : View
    {
        $sellers = Seller::all();
        return view('dashboard', compact('sellers'));
    }

    public function generateReportForUniqueSeller(Request $request): RedirectResponse
    {
        $id = $request->input('seller_id');
        $seller = Seller::find($id);
        if (!$seller) {
            return redirect()->route('dashboard')->with('status', 'generate-unique-report-error')->with('message', 'Vendedor não encontrado');
        }
        $this->adminServices->generateReportForSeller($seller);
        return redirect()->route('dashboard')->with("status", "generate-unique-report-success")->with('message', 'Relatório enviado com sucesso');
    }

    public function finishDay(Request $request): RedirectResponse
    {
        $password = $request->input('password');
        $user = auth()->user();
        if (!\Hash::check($password, $user->password)) {
            return redirect()->route('dashboard')->with('status', 'finish-day-error')->with('message', 'Senha incorreta');
        }
        $this->adminServices->generateReportForAllSellers();
        $this->adminServices->generateReportForAdmin($user);
        return redirect()->route('dashboard')->with("status", "finish-day-success")->with('message', 'Relatórios enviados com sucesso');
    }


}
