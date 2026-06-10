<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function loadProducts()
    {
        $products = Product::orderBy('id', 'desc')->get();

        return DataTables::of($products)

            ->editColumn('created_at', function ($product) {
                return date('d-m-Y H:i:s', strtotime($product->created_at));
            })

            ->addColumn('action', function ($product) {

                $editUrl = route('products.edit', $product->id);

                return "
                <a href='{$editUrl}' class='btn btn-sm btn-success'>Edit</a>

                <form action='" . route('products.destroy', $product->id) . "'
                      method='POST'
                      style='display:inline-block; margin-left:5px;'>

                    " . csrf_field() . "
                    " . method_field('DELETE') . "

                    <button type='submit'
                            class='btn btn-sm btn-danger'
                            onclick=\"return confirm('Are you sure?')\">
                        Delete
                    </button>
                </form>
            ";
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('products.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'rating' => $request->rating,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }


    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
