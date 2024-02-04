<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Services\SaleServices;

class SaleController extends Controller
{

    private SaleServices $saleServices;
    public function __construct(SaleServices $saleServices)
    {
        $this->saleServices = $saleServices;
    }

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

        $data = array(
            "seller_id" => $request->input('seller_id'),
            "value" => $request->input('value'),
            "date" => $request->input('date')
        );

        $inserted = $this->saleServices->insert($data);

        if ($inserted) {
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

        $request->validate([
            'seller_id' => 'required|integer',
            'value' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $data = array(
            "seller_id" => $request->input('seller_id'),
            "value" => $request->input('value'),
            "date" => $request->input('date')
        );

        $updated = $this->saleServices->update($data, $id);

        if ($updated) {
            return redirect()->back()->with('status', 'success')->with('message', 'Venda atualizada com sucesso!');
        }

        return redirect()->back()->with('status', 'error')->with('message', 'Erro ao atualizar venda!');
    }

    public function destroy(int $id)
    {
        $deleted = $this->saleServices->delete($id);

        if ($deleted) {
            return redirect()->back()->with('status', 'success')->with('message', 'Venda excluída com sucesso!');
        }

        return redirect()->back()->with('status', 'error')->with('message', 'Erro ao excluir venda!');
    }
}
