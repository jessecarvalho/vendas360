<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = Seller::all();
        return view('sellers.index', compact('sellers'));
    }

    public function create()
    {
        return view('sellers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:sellers,email',
        ]);

        $seller = Seller::create($request->all());

        if ($seller) {
            return redirect()->back()->with('status', 'success')->with('message', 'Vendedor criado com sucesso!');
        }

        return redirect()->back()->with('status', 'error')->with('message', 'Erro ao criar vendedor!');

    }

    public function edit(int $id)
    {
        $seller = Seller::find($id);

        if (!$seller) {
            return redirect()->back()->with('status', 'error')->with('message', 'Vendedor não encontrado!');
        }

        return view('sellers.edit', compact('seller'));
    }

    public function update(int $id, Request $request)
    {
        $seller = Seller::find($id);

        if (!$seller) {
            return redirect()->back()->with('status', 'error')->with('message', 'Vendedor não encontrado!');
        }

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:sellers,email,' . $seller->id,
        ]);

        $updated = $seller->update($request->all());

        if ($updated) {
            return redirect()->back()->with('status', 'success')->with('message', 'Vendedor atualizado com sucesso!');
        }

        return redirect()->back()->with('status', 'error')->with('message', 'Erro ao atualizar vendedor!');

    }

    public function destroy(int $id)
    {
        $seller = Seller::find($id);

        if (!$seller) {
            return redirect()->back()->with('status', 'error')->with('message', 'Vendedor não encontrado!');
        }

        $deleted = $seller->delete();

        if ($deleted) {
            return redirect()->back()->with('status', 'success')->with('message', 'Vendedor excluído com sucesso!');
        }

        return redirect()->back()->with('status', 'error')->with('message', 'Erro ao excluir vendedor!');
    }
}
