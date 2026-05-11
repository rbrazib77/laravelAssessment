<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index(Request $request){
     $query = Customer::query();
        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%");
            });
        }
      $customers = $query->latest()->paginate(5)->withQueryString();
     return view('admin.customers.index', compact('customers'));

    }

     public function create(){
      return view('admin.customers.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'    => 'required',
            'phone'   => 'required|unique:customers,phone',
            'email'   => 'required|email',
            'address' => 'required',
        ]);

        Customer::create([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'email'   => $request->email,
            'address' => $request->address,
        ]);

        return redirect()->back()->with([
            'message' => 'Customer created successfully!',
            'alert-type' => 'success'
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'    => 'required',
            'phone'   => 'required',
            'email'   => 'required|email',
            'address' => 'required',
        ]);
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return redirect()->back()->with([
            'message' => 'Customer Update',
            'alert-type' => 'success'
        ]);
        return redirect()->route('customers.index');
    }

    public function destroy($id){
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->back()->with([
            'message' => 'Customers Deleted Successfully',
            'alert-type' => 'error'
            ]);
    }

}
