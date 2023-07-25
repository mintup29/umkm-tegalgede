<?php

namespace App\Http\Controllers;

use App\TransactionDetail;
use App\User;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = TransactionDetail::with(['transaction.user','product.galleries'])
                            ->whereHas('product', function($product){
                                $product->where('users_id', Auth::user()->id);
                            });

        $sum_product = Product::count();

        $products = Product::with('galleries')->get();
        // dd($products);

        $customer = User::count();

        return view('pages.dashboard',[
            'transaction_count' => $transactions->count(),
            'transaction_data' => $transactions->get(),
            'products' => $products,
            'sum_product' => $sum_product,
            'customer' => $customer,
        ]);
    }
}
