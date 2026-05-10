<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index(Request $request){
        $categories = Category::all();
        $products = Product::with('category')
            ->when($request->search, function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%");
                });
            })->latest()->paginate(5)->withQueryString();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'sku' => 'required|unique:products',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'image' => 'nullable|image',
            'status' => 'required',
        ]);
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('products'),$imageName);
        }
        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'sku' => $request->sku,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity,
            'image' => $imageName,
            'status' => $request->status,
        ]);
        return redirect()->back()->with([
            'message' => 'Product Created Successfully',
            'alert-type' => 'success'
         ]);
    }

    public function show($id){
        $product = Product::findOrFail($id);
        return view('admin.products.show',compact('product'));
    }

   public function edit($id){
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
   }

    public function update(Request $request, $id){
         $product = Product::findOrFail($id);
         $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'sku' => 'required|unique:products,sku,' . $product->id,
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'status' => 'required',
        ]);
        $imageName = $product->image;
        if ($request->hasFile('image')) {

            $imageName = time().'.'.
                $request->image->extension();

            $request->image->move(
                public_path('products'),
                $imageName
            );
        }
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'sku' => $request->sku,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity,
            'image' => $imageName,
            'status' => $request->status,
        ]);
        return redirect()->back()->with([
            'message' => 'Product Updated Successfully!',
            'alert-type' => 'success'
        ]);
        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Product Updated Successfully'
            );
    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with([
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'error'
         ]);
    }
}
