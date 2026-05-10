<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(){
          $categories = Category::latest()->paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:categories,name',
            'status' => 'required|in:active,inactive',
            'order' => 'required|integer|unique:categories,order',
        ]);

        Category::create([
            'name' => $request->name,
            'status' => $request->status,
            'order' => $request->order,
        ]);

        return redirect()->back()->with([
            'message' => 'Category created!',
            'alert-type' => 'success'
        ]);
    }

    public function update(Request $request, $id){
        $category = Category::findOrFail($id);

         $request->validate([
            'name' => 'required',
            'status' => 'required',
            'order' => 'required|integer',
        ]);

         $category->update([
            'name' => $request->name,
            'status' => $request->status,
            'order' => $request->order,
        ]);
        return redirect()->back()->with([
            'message' => 'Category updated!',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id){
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with([
            'message' => 'Category deleted!',
            'alert-type' => 'error'
        ]);
    }
}
