<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\JsonResponse;

class InvoiceController extends Controller
{
    public function getAllInvoice() : JsonResponse
    {
        $invoices = Invoice::with('customer')->orderBy('id','DESC')->get();

        return response()->json([
            'invoices' => $invoices
        ]);
    }

    public function searchInvoice() : JsonResponse
    {
        $search = request()->get('search');
        $searchInvoice = Invoice::with('customer')
                                ->where('id','LIKE',"%$search%")
                                ->get();

        return response()->json([
            'invoices' => $searchInvoice
        ]);
    }

}
