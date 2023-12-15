<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $invoices = Invoice::factory(5);
        $products = Product::factory()->count(5);
        $pivot_array = [
            'unit_price' => fake()->randomFloat(random_int(0,3),1000,100000),
            'quantity' => random_int(1,10)
        ];
        $foreignId = [
            'customer_id' => random_int(1,5)
        ];

        $invoices->hasAttached($products, $pivot_array)->create($foreignId);
    }
}
