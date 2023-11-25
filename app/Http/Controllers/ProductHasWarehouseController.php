<?php

namespace App\Http\Controllers;

use App\Models\ProductHasWarehouse;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Warehouse;

/**
 * Class ProductHasWarehouseController
 * @package App\Http\Controllers
 */
class ProductHasWarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productHasWarehouses = ProductHasWarehouse::paginate();

        return view('product-has-warehouse.index', compact('productHasWarehouses'))
            ->with('i', (request()->input('page', 1) - 1) * $productHasWarehouses->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productHasWarehouse = new ProductHasWarehouse();
        $products = Product::pluck('name', 'id');
        $warehouses = Warehouse::pluck('name', 'id');
        return view('product-has-warehouse.create', compact('productHasWarehouse', 'products', 'warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ProductHasWarehouse::$rules);

        $productHasWarehouse = ProductHasWarehouse::create($request->all());

        return redirect()->route('product-has-warehouses.index')
            ->with('success', 'ProductHasWarehouse created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($productId, $warehouseId)
    {
        $productHasWarehouse = ProductHasWarehouse::where('product_id', $productId)
        ->where('warehouse_id', $warehouseId)
        ->first();

        return view('product-has-warehouse.show', compact('productHasWarehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($productId, $warehouseId)
    {
        $productHasWarehouse = ProductHasWarehouse::where('product_id', $productId)
        ->where('warehouse_id', $warehouseId)
        ->first();

        $products = Product::pluck('name', 'id');
        $warehouses = Warehouse::pluck('name', 'id');

        return view('product-has-warehouse.edit', compact('productHasWarehouse', 'warehouses', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProductHasWarehouse $productHasWarehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $productId, $warehouseId)
    {
        request()->validate(ProductHasWarehouse::$rules);

        ProductHasWarehouse::where('product_id', $productId)
            ->where('warehouse_id', $warehouseId)
            ->update($request->all());

        return redirect()->route('product-has-warehouses.index')
                ->with('success', 'ProductHasWarehouse updated successfully');
    

    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($productId, $warehouseId)
    {
        $deletedRows = ProductHasWarehouse::where('product_id', $productId)
            ->where('warehouse_id', $warehouseId)
            ->delete();

        if ($deletedRows > 0) {
            return redirect()->route('product-has-warehouses.index')
                ->with('success', 'ProductHasWarehouse deleted successfully');
        } else {
            return redirect()->route('product-has-warehouses.index')
                ->with('error', 'ProductHasWarehouse not found');
        }
    }
}
