<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Phone;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // ...existing code...

    public function dashboard()
    {
        $userCount = User::where('is_admin', false)->count();
        $phoneCount = Phone::count();
        $orderCount = Order::count();
        $todayRevenue = Order::whereDate('created_at', today())->sum('total_amount');
        return view('admin.dashboard', compact('userCount', 'phoneCount', 'orderCount', 'todayRevenue'));
    }

    // ...existing code...
}