<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return $this->product->getProducts();
    }

}
