<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Services\SellerServices;

class SellerController extends Controller
{
    private SellerServices $sellerServices;

    public function __construct(SellerServices $sellerServices)
    {
        $this->sellerServices = $sellerServices;
    }
    public function index() : View
    {
        $sellers = Seller::all();
        return view('sellers.index', compact('sellers'));
    }

    public function create() : View
    {
        return view('sellers.create');
    }

    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:sellers,email',
        ]);

        $data = array(
            "name" => $request->input('name'),
            "email" => $request->input('email')
        );

        $inserted = $this->sellerServices->insert($data);

        if ($inserted) {
            return redirect()->back()->with('status', 'success')->with('message', 'Vendedor criado com sucesso!');
        }

        return redirect()->back()->with('status', 'error')->with('message', 'Erro ao criar vendedor!');
    }

    public function edit(int $id) : View | RedirectResponse
    {
        $seller = Seller::find($id);

        if (!$seller) {
            return redirect()->back()->with('status', 'error')->with('message', 'Vendedor não encontrado!');
        }

        return view('sellers.edit', compact('seller'));
    }

    public function update(int $id, Request $request) : RedirectResponse
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:sellers,email,' . $id,
        ]);

        $data = array(
            "name" => $request->input('name'),
            "email" => $request->input('email')
        );

        $updated = $this->sellerServices->update($data, $id);

        if ($updated) {
            return redirect()->back()->with('status', 'success')->with('message', 'Vendedor atualizado com sucesso!');
        }

        return redirect()->back()->with('status', 'error')->with('message', 'Erro ao atualizar vendedor!');

    }

    public function destroy(int $id) : RedirectResponse
    {

        $deleted = $this->sellerServices->delete($id);

        if ($deleted) {
            return redirect()->back()->with('status', 'success')->with('message', 'Vendedor excluído com sucesso!');
        }

        return redirect()->back()->with('status', 'error')->with('message', 'Erro ao excluir vendedor!');
    }
}
