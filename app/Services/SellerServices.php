<?php

namespace App\Services;

use App\Models\Seller;

class SellerServices
{
    public function insert(array $data): bool
    {

        $seller = new Seller(
            [
                "name" => $data['name'],
                "email" => $data['email']
            ]
        );
        return $seller->save();
    }

    public function update(array $data, int $id): bool
    {
        $seller = Seller::find($id);
        if (!$seller) {
            return false;
        }
        $seller->name = $data['name'];
        $seller->email = $data['email'];
        return $seller->save();
    }

    public function delete(int $id): bool
    {
        $seller = Seller::find($id);
        if (!$seller) {
            return false;
        }
        return $seller->delete();
    }

}
