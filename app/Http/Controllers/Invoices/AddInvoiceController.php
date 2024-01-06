<?php

namespace App\Http\Controllers\invoices;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AddInvoiceController extends Controller
{
    public function __invoke(Request $request)
    {



        $invoce_item = $request->input('invoice_item');
        $invoice_data = [
            'customer_id' => $request->input('customer_id'),
            'reference' => $request->input('reference'),
            'sub_total' => $request->input('subtotal'),
            'total' => $request->input('total'),
            'date' => $request->input('date'),
            'due_date' => $request->input('due_date'),
            'discount' => $request->input('discount'),
            'term_and_condition' => $request->input('term_and_condition'),
            'number' => $request->input('number')
        ];

        $invoiceCreated = Invoice::create($invoice_data);

        foreach (json_decode($invoce_item) as $item){
            $invoiceCreated->products()->attach($item->id,[
                'unit_price' => $item->unit_price,
                'quantity' => $item->quantity
            ]);
        }
        return response()->json([
            'succès' => 'Facture crée avec succès'
        ]);
    }
}
