<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
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

    public function getAllCustomers() : JsonResponse
    {
        $customers = Customer::latest()->get();

        return response()->json([
            'customers' => $customers
        ]);
    }

    public function getAllProducts() : JsonResponse
    {

        $products = Product::with('invoices')->latest()->take(10)->get();
        return response()->json([
            'products' => $products
        ]);
    }

    public function getInvoice($id) : JsonResponse
    {
        $invoice = Invoice::with('customer','products')->find($id);

        return response()->json([
            'invoice' => $invoice
        ]);
    }

}
