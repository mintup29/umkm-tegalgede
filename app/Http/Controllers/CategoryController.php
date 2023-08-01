<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\CategoryRequest;

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

        return view('pages.category',[
            'categories' => $categories,
            'category' => $category,
            'products' => $products
        ]);
    }

    public function search(Request $request) 
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', '%' . $query . '%')->paginate(12);

        return view('pages.search', compact('products', 'query'));
    }

    public function indexCategory()
    {
        $category = Category::get();
        // dd($category);

        return view('pages.dashboard-category',[
            'categories' => $category
        ]);
    }

    public function detailsCategory($id)
    {
        $category = Category::findOrFail($id);
        // dd($category);

        return view('pages.dashboard-category-details',[
            'categories' => $category,
        ]);
    }
    
    public function create()
    {
        return view('pages.admin.category.create');
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('name'); 

        $item = Category::findOrFail($id);

        $data['slug'] = Str::slug($request->name);
        // dd($data);

        $item->update($data);

        return redirect()->route('dashboard-category');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['photo'] = $request->file('photo')->store('assets/product', 'public');
        // $data = $request->file('photo')->store('assets/product', 'public');
        // dd($data);

        $product = Category::create($data);

        return redirect()->route('dashboard-category');
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = Category::findorFail($id);
        // dd($item);
        $item->delete();

        return redirect()->route('dashboard-category');
    }
    
}
