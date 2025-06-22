<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership; // <-- Import model Membership
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua membership yang statusnya pending, dan sertakan data user-nya
        // with('user') digunakan untuk Eager Loading, ini performa yang baik!
        $pendingMemberships = Membership::where('payment_status', 'pending')->with('user')->get();

        // Kirim data ke view
        return view('admin.dashboard', compact('pendingMemberships'));
    }
}

