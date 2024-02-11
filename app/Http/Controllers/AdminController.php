<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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
        $admin = Admin::first();
        return view('dashboard', compact('sellers', 'admin'));
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

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'commission' => 'required|numeric'
        ]);

        $data = array(
            "name" => $request->input('name'),
            "email" => $request->input('email'),
            "commission" => $request->input('commission')
        );

        $isInserted = $this->adminServices->update($data);

        if (!$isInserted) {
            return redirect()->route('dashboard')->with('status', 'update-admin-info-error')->with('message', 'Erro ao atualizar informações');
        }
        return redirect()->route('dashboard')->with('status', 'update-admin-info-success')->with('message', 'Informações atualizadas com sucesso');
    }

}
