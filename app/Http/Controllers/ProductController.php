<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductHasWarehouse;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::paginate();

        return view('product.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * $products->perPage());
    }

    public function create()
    {
        $product = new Product();
        $categories =Category::pluck('name','id');
        $warehouses = Warehouse::pluck('name','id');
        return view('product.create', compact('product', 'categories', 'warehouses'));
    }

    public function store(Request $request)
    {
        request()->validate(Product::$rules);

        $product = Product::create($request->all());
        $product->warehouses()->attach($request->input('warehouse_ids'));


        return response()->json(['success' => true, 'message' => 'Producto creado correctamente.',"redirect" => route('products.index')]);

    }

    public function show($id)
    {
        $product = Product::find($id);
        $categories =Category::pluck('name','id');
        $warehouses = Warehouse::pluck('name','id');

        return view('product.show', compact('product', 'categories', 'warehouses'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories=Category::pluck('name','id');
        $warehouses = Warehouse::pluck('name','id');
        return view('product.edit', compact('product', 'categories', 'warehouses'));
    }

    public function update(Request $request, Product $product)
    {
        request()->validate(Product::$rules);

        $product->update($request->all());
        $product->warehouses()->sync($request->input('warehouse_ids'));
        
        return response()->json(['success' => true, 'message' => 'Producto editado correctamente.',"redirect" => route('products.index')]);

    }

    public function destroy($id)
    {
        Product::find($id)->delete();

        return redirect()->route('products.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}
