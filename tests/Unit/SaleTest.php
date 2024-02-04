<?php

namespace Tests\Unit;

use App\Models\Seller;
use App\Services\SellerServices;
use Tests\TestCase;
use App\Services\SaleServices;
use App\Models\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SaleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $sellerServices = new SellerServices();
        $sellerData = [
            "name" => "John Doe",
            "email" => "john@gmail.com",
        ];
        $sellerServices->insert($sellerData);
        $this->seller = Seller::where('email', 'john@gmail.com')->first();
    }

    public function test_insert_sale()
    {
        $saleServices = new SaleServices();
        $data = [
            "seller_id" => $this->seller->id,
            "value" => 100,
            "date" => "01/01/2024",
        ];
        $inserted = $saleServices->insert($data);
        $this->assertTrue($inserted);
    }

    public function test_update_sale()
    {
        $saleServices = new SaleServices();
        $data = [
            "seller_id" => $this->seller->id,
            "value" => 100,
            "date" => "01/01/2024",
        ];
        $inserted = $saleServices->insert($data);
        $this->assertTrue($inserted);
        $sale = Sale::where('value', 100)->first();
        $data = [
            "seller_id" => $this->seller->id,
            "value" => 200,
            "date" => "01/01/2024",
        ];
        $updated = $saleServices->update($data, $sale->id);
        $this->assertTrue($updated);
    }

    public function test_delete_sale()
    {
        $saleServices = new SaleServices();
        $data = [
            "seller_id" => $this->seller->id,
            "value" => 100,
            "date" => "01/01/2024",
        ];
        $inserted = $saleServices->insert($data);
        $this->assertTrue($inserted);

        $sale = Sale::where('value', 100)->first();
        $this->assertNotNull($sale, 'Sale was not inserted correctly');

        $deleted = $saleServices->delete($sale->id);
        $this->assertTrue($deleted, 'Sale was not deleted correctly');

        $sale = Sale::where('value', 100)->first();
        $this->assertNull($sale, 'Sale was not deleted correctly');
    }

}
