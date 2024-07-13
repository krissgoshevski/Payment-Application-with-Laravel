<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // return Product::with(['categories' => function ($query) {
        //     $query->select('id', 'name'); // Ovde mozete da specificirate gi kolonite sto sakate da gi zemete od tabelata Category
        // }])->get();
         
        // return Product::with('categories')->get();
        return Product::with('categories:id,name')->get(); // od relacijata categories da gi zeme samo id i name od modelot Category 
    }
}
