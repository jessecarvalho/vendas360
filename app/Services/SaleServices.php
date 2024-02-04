<?php

namespace App\Services;

use App\Models\Sale;

class SaleServices
{
    public function insert(array $data): bool
    {
        $sale = new Sale(
            [
                "seller_id" => $data['seller_id'],
                "value" => $data['value'],
                "date" => $data['date'],
            ]
        );
        return $sale->save();
    }

    public function update(array $data, int $id): bool
    {
        $sale = Sale::find($id);
        if (!$sale) {
            return false;
        }
        $sale->seller_id = $data['seller_id'];
        $sale->value = $data['value'];
        $sale->date = $data['date'];
        return $sale->save();
    }

    public function delete(int $id): bool
    {
        $sale = Sale::find($id);
        if (!$sale) {
            return false;
        }
        return $sale->delete();
    }

}
