<?php

namespace Tests\Unit;

use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\SellerServices;

class SellerTest extends TestCase
{

    use RefreshDatabase;

    public function test_insert_seller()
    {
        $sellerServices = new SellerServices();
        $data = [
            "name" => "John Doe",
            "email" => "john@gmail.com",
        ];
        $inserted = $sellerServices->insert($data);
        $this->assertTrue($inserted);
    }

    public function test_update_seller()
    {
        $sellerServices = new SellerServices();
        $data = [
            "name" => "John Doe",
            "email" => "john@gmail.com",
        ];
        $inserted = $sellerServices->insert($data);
        $this->assertTrue($inserted);
        $seller = Seller::where('email', 'john@gmail.com')->first();
        $data = [
            "name" => "John Doe Updated",
            "email" => "johndoe2@gmail.com",
        ];
        $updated = $sellerServices->update($data, $seller->id);
        $this->assertTrue($updated);
    }

    public function test_delete_seller()
    {
        $sellerServices = new SellerServices();
        $data = [
            "name" => "John Doe",
            "email" => "john@gmail.com",
        ];
        $inserted = $sellerServices->insert($data);
        $this->assertTrue($inserted);

        $seller = Seller::where('email', 'john@gmail.com')->first();
        $this->assertNotNull($seller, 'Seller was not inserted correctly');

        $deleted = $sellerServices->delete($seller->id);
        $this->assertTrue($deleted, 'Seller was not deleted correctly');

        $this->assertDatabaseMissing('sellers', [
            'id' => $seller->id,
        ]);
    }


}
