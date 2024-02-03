<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Seller;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('seller')->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $sellers = Seller::all();
        return view('sales.create', compact('sellers'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'seller_id' => 'required|integer',
            'value' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $sale = Sale::create($request->all());

        if ($sale) {
            return redirect()->back()->with('status', 'success')->with('message', 'Venda criada com sucesso!');
        }

        return redirect()->back()->with('status', 'error')->with('message', 'Erro ao criar venda!');
    }

    public function edit(int $id)
    {
        $sale = Sale::find($id);

        if (!$sale) {
            return redirect()->back()->with('status', 'error')->with('message', 'Venda não encontrada!');
        }

        $sellers = Seller::all();

        return view('sales.edit', compact('sale', 'sellers'));
    }

    public function update(int $id, Request $request)
    {

        $sale = Sale::find($id);

        if (!$sale) {
            return redirect()->back()->with('status', 'error')->with('message', 'Venda não encontrada!');
        }

        $request->validate([
            'seller_id' => 'required|integer',
            'value' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $updated = $sale->update($request->all());

        if ($updated) {
            return redirect()->back()->with('status', 'success')->with('message', 'Venda atualizada com sucesso!');
        }

        return redirect()->back()->with('status', 'error')->with('message', 'Erro ao atualizar venda!');
    }

    public function destroy(int $id)
    {
        $sale = Sale::find($id);

        if (!$sale) {
            return redirect()->back()->with('status', 'error')->with('message', 'Venda não encontrada!');
        }

        $deleted = $sale->delete();

        if ($deleted) {
            return redirect()->back()->with('status', 'success')->with('message', 'Venda excluída com sucesso!');
        }

        return redirect()->back()->with('status', 'error')->with('message', 'Erro ao excluir venda!');
    }
}
