<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Sale; 
use App\Models\Review;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function showRegister()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:admins',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:5|confirmed',
        ]);

        Admin::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.login')->with('success', 'Admin registered successfully!');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
    
            $admin->last_login = now(); 
            $admin->save(); 
    
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showOrders()
    {
        $orders = Order::all(); 
        return view('admin.orders', compact('orders'));
        
    }

    public function showSales(Request $request)
    {
        $sales = Sale::all(); 
        $period = $request->get('period', 'daily'); 

    switch ($period) {
        case 'monthly':
            $sales = Sale::selectRaw('YEAR(sale_date) as year, MONTH(sale_date) as month, SUM(total_amount) as total_amount')
                        ->groupBy('year', 'month')
                        ->orderBy('year', 'desc')
                        ->orderBy('month', 'desc')
                        ->get();
            break;

        case 'yearly':
            $sales = Sale::selectRaw('YEAR(sale_date) as year, SUM(total_amount) as total_amount')
                        ->groupBy('year')
                        ->orderBy('year', 'desc')
                        ->get();
        break;
    }

    return view('admin.sales', compact('sales', 'period'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'total_amount' => 'required|numeric|min:0',
            'sale_date' => 'required|date',
        ]);

        Sale::create([
            'total_amount' => $request->total_amount,
            'sale_date' => $request->sale_date,
        ]);

        return redirect()->route('admin.sales')->with('success', 'Sale added successfully');
    }

    /*public function calculateSales(Request $request)
    {
        $period = $request->get('period', 'daily'); 

        switch ($period) {
            case 'monthly':
                $sales = Sale::selectRaw('YEAR(sale_date) as year, MONTH(sale_date) as month, SUM(total_amount) as total_amount')
                            ->groupBy('year', 'month')
                            ->orderBy('year', 'desc')
                            ->orderBy('month', 'desc')
                            ->get();
                break;

            case 'yearly':
                $sales = Sale::selectRaw('YEAR(sale_date) as year, SUM(total_amount) as total_amount')
                            ->groupBy('year')
                            ->orderBy('year', 'desc')
                            ->get();
                break;

            default:
                $sales = Sale::selectRaw('sale_date, SUM(total_amount) as total_amount')
                            ->groupBy('sale_date')
                            ->orderBy('sale_date', 'desc')
                            ->get();
                break;
        }
        
        return view('admin.sales', compact('sales', 'period'));
    }*/


    public function updateSale(Request $request, Sale $sale)
    {
        $request->validate([
            'total_amount' => 'required|numeric|min:0',
            'sale_date' => 'required|date',
        ]);

        $sale->update([
            'total_amount' => $request->total_amount,
            'sale_date' => $request->sale_date,
        ]);

        return redirect()->route('admin.sales', $sale->id)->with('success', 'Sale updated successfully');
    }

    public function destroySale($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();
        
        return redirect()->route('admin.sales')->with('success', 'Sale deleted successfully');
    }

    public function showReviews()
    {
        $reviews = Review::all();
        return view('admin.reviews', compact('reviews'));
    }

    public function deleteReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.reviews')->with('success', 'Review deleted successfully.');
    }

    public function showAdminList()
    {
        $admins = Admin::all(); 
        return view('admin.adminList', compact('admins'));
    }

    public function showDashboard()
    {

        $orderCount = Order::count(); 
        $totalRevenue = Order::sum('total_amount'); 
        $pendingOrders = Order::where('status', 'pending')->count(); 

        $salesCount = Sale::count();
        $totalSalesRevenue = Sale::sum('total_amount'); 
        $reviewsCount = Review::count(); 
        $averageRating = Review::avg('rating'); 

        $adminCount = Admin::count(); 
        $lastAdminLogin = Admin::latest('last_login')->first()->last_login ?? 'No login data'; 

        return view('admin.dashboard', compact(
            'orderCount', 
            'totalRevenue', 
            'pendingOrders', 
            'salesCount', 
            'totalSalesRevenue', 
            'reviewsCount', 
            'averageRating', 
            'adminCount', 
            'lastAdminLogin'
        ));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id, 
        ]);

        $admin = Admin::findOrFail($id);

        $admin->update([
            'username' => $request->username,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.adminList')->with('success', 'Admin updated successfully.');
    }


    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return redirect()->route('admin.adminList')->with('success', 'Admin deleted successfully.');
    }

    public function destroyOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        
        return redirect()->route('admin.orders')->with('success', 'Order deleted successfully.');
    }

    public function updateOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'total_amount' => 'required|numeric',
            'status' => 'required|string',
            'destination' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        $order->customer_name = $request->input('customer_name');
        $order->total_amount = $request->input('total_amount');
        $order->status = $request->input('status');
        $order->destination = $request->input('destination');
        $order->quantity = $request->input('quantity');
        
        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Order updated successfully.');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
