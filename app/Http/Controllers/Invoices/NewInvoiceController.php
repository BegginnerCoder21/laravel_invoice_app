<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewInvoiceController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $invoice = Invoice::orderBy('id','DESC')->first();
        $counter = Counter::where('key','INVOICE')->first();

        if($invoice){
            $invoice = $invoice->id + 1;
            $counters = $counter->value + $invoice;
        }else{
            $counters = $counter->value;
        }

        $formData = [
            'number' => $counter->prefix . $counters,
            'customer_id' => null,
            'customer' => null,
            'date' => date('d-m-Y'),
            'due_date' => null,
            'reference' => null,
            'discount' => 0,
            'term_and_condition' => 'Default terms and conditions',
            'items' => [
                'product_id' => null,
                'product' => null,
                'unit_price' => 0,
                'quantity' => 1
            ]
        ];

        return response()->json($formData);
    }
}
