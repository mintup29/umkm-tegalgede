<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::paginate($request->input('limit', 12));

        return view('pages.category',[
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function detail(Request $request, $slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('categories_id', $category->id)->paginate($request->input('limit', 12));

        // $query = $request->input('query');
        // $products_search = Product::where('name', 'like', '%' . $query . '%')->paginate(12);

        return view('pages.category',[
            'categories' => $categories,
            'category' => $category,
            'products' => $products
            // 'products_search' => $products_search,
            // 'query' => $query
        ]);
    }

    public function search(Request $request) 
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', '%' . $query . '%')->paginate(12);

        return view('pages.search', compact('products', 'query'));
    }
}
