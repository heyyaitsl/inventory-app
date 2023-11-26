<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\Product;

class WarehouseController extends Controller
{
  
    public function index()
    {
        $warehouses = Warehouse::paginate();

        return view('warehouse.index', compact('warehouses'))
            ->with('i', (request()->input('page', 1) - 1) * $warehouses->perPage());
    }

    public function create()
    {
        $warehouse = new Warehouse();
        $products = Product::pluck('name','id');
        return view('warehouse.create', compact('warehouse', 'products'));
    }

    public function store(Request $request)
    {
        request()->validate(Warehouse::$rules);

        $warehouse = Warehouse::create($request->all());
        $warehouse->products()->attach($request->input('product_ids'));

        return response()->json(['success' => true, 'message' => 'Almacén creado correctamente.',"redirect" => route('warehouses.index')]);

    }

    public function show($id)
    {
        $warehouse = Warehouse::find($id);

        return view('warehouse.show', compact('warehouse'));
    }

    public function edit($id)
    {
        $warehouse = Warehouse::find($id);
        $products = Product::pluck('name','id');

        return view('warehouse.edit', compact('warehouse', 'products'));
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        request()->validate(Warehouse::$rules);

        $warehouse->update($request->all());
        $warehouse->products()->sync($request->input('product_ids'));

        return response()->json(['success' => true, 'message' => 'Almacén editado correctamente.',"redirect" => route('warehouses.index')]);

    }

    public function destroy($id)
    {
        Warehouse::find($id)->delete();

        return redirect()->route('warehouses.index')
            ->with('success', 'Almacén eliminado correctamente.');	
    }
}
