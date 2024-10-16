<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; //Product Model

class ProductController extends Controller
{
    public function index()
    {
        // Fetch all products
        $products = Product::all();

        return response()->json($products);
    }
}
