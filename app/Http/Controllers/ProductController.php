<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;

class ProductController extends Controller
{
    public function index() {
    	$products = Product::with('imgs')->get();
    	return view('product.index', compact('products'));
    }


    public function show($id) {
    	$product = Product::findOrfail($id);
    	return view('product.show', compact('product'));
    }

}
