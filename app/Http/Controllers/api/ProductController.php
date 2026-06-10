<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

        Product::findOrFail(999999);

        return response()->json([
            'status' => true,
            'message' => 'Products retrieved successfully',
            'data' => Product::latest()->get()
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
