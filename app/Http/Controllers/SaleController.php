<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SaleItem;
use Illuminate\Support\Str;
use DB;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    
    public function index(Request $request){
        $sales = Sale::with('customer', 'saleItems.product')->when($request->date, function ($query) use ($request) {
                $query->whereDate('created_at', $request->date);
            })->latest()->paginate(5);
        return view('admin.sales.index', compact('sales'));
    }

    public function create(){
        $customers = Customer::all();
        $products = Product::where('status','active')->get();
        return view('admin.sales.create',compact('customers','products'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        try {
            DB::transaction(function () use ($request) {
                $today = now()->format('Ymd');

                $count = Sale::whereDate('created_at', now())->count() + 1;

                $invoiceId = 'INV-' . $today . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
                $sale = Sale::create([
                    'invoice_id' => $invoiceId,
                    'customer_id' => $request->customer_id,
                    'total' => $request->total,
                    'discount' => $request->discount,
                    'grand_total' => $request->grand_total,
                ]);
                foreach ($request->products as $item) {
                    $product = Product::find($item['product_id']);
                    // Stock check
                    if (!$product || $product->stock_quantity < $item['quantity']) {
                        throw new \Exception('Stock Not Available for ' . ($product->name ?? 'Unknown Product'));
                    }
                    SaleItem::create([
                        'sale_id' => $sale->id,
                        'product_id' => $product->id,
                        'quantity' => $item['quantity'],
                        'price' => $product->price,
                        'subtotal' => $product->price * $item['quantity'],
                    ]);
                    $product->decrement('stock_quantity', $item['quantity']);
                }
            });
                return redirect()->route('sales.index')->with([
                'message' => 'Invoice Created Successfully',
                'alert-type' => 'success'
            ]);

        } catch (\Exception $e) {
                return redirect()->back()->with([
                'message' => 'No Stock Available',
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
   public function show($id){
      $sale = Sale::with('customer', 'saleItems.product')->findOrFail($id);
      return view('admin.sales.invoice', compact('sale'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }

    public function downloadInvoice($id){
        $sale = Sale::with('customer', 'saleItems.product')->findOrFail($id);
        $pdf = Pdf::loadView('admin.sales.invoice_pdf', compact('sale'));
        return $pdf->download('invoice-' . $sale->invoice_id . '.pdf');
    }

}
