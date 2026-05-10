<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function AdminLogout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function index(){
        $totalProducts = Product::count();
        $totalCustomers = Customer::count();
        $totalSales = Sale::count();
        $totalRevenue = Sale::sum('grand_total');
        $lowStockCount = Product::where('stock_quantity','<', 5)->count();
        $lowStockProducts = Product::where('stock_quantity','<',5)->get();
        return view('admin.dashboard',compact('totalProducts','totalCustomers','totalSales','totalRevenue','lowStockCount','lowStockProducts'
        )
     );
   }

    public function userList(){
        $users=User::latest()->paginate(5);
        return view('admin.user.index',compact('users'));
    }
   
    public function userDestroy($id){
        $users = User::findOrFail($id);
        $users->delete();

        return redirect()->back()->with([
            'message' => 'User deleted!',
            'alert-type' => 'error'
        ]);
    }
 
}
