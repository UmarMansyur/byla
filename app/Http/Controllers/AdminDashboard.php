<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboard extends Controller
{
    public function index()
    {
        $total_users = User::count();
        $total_users_percentage = User::whereMonth('created_at', date('m'))->count() - User::whereMonth('created_at', date('m') - 1)->count();
        $total_transactions = Transaction::count();
        $total_transactions_percentage = Transaction::whereMonth('created_at', date('m'))->count() - Transaction::whereMonth('created_at', date('m') - 1)->count();
        $total_merchants = Merchant::count();
        $total_merchants_percentage = Merchant::whereMonth('created_at', date('m'))->count() - Merchant::whereMonth('created_at', date('m') - 1)->count();
        $total_revenue = Transaction::where('status', 'success')
            ->whereMonth('created_at', date('m'))
            ->sum('nominal');

        $last_month_revenue = Transaction::where('status', 'success')
            ->whereMonth('created_at', date('m', strtotime('-1 month')))
            ->sum('nominal');

        $total_revenue_percentage = $last_month_revenue > 0
            ? (($total_revenue - $last_month_revenue) / $last_month_revenue) * 100
            : 0;

        $data_transaction_chart = [];
        for ($i = 1; $i <= 12; $i++) {
            array_push($data_transaction_chart, [
                'month' => $i,
                'nominal' => Transaction::where('status', 'success')
                    ->whereMonth('created_at', $i)
                    ->sum('nominal')
            ]);
        }

        $history_transaction = Transaction::with(['user', 'merchant'])->get();

        return view('admin.dashboard.index', compact('total_users', 'total_users_percentage', 'total_transactions', 'total_transactions_percentage', 'total_merchants', 'total_merchants_percentage', 'total_revenue', 'total_revenue_percentage', 'data_transaction_chart', 'history_transaction'));
    }
}
