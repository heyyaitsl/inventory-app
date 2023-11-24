<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

/**
 * Class WarehouseController
 * @package App\Http\Controllers
 */
class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::paginate();

        return view('warehouse.index', compact('warehouses'))
            ->with('i', (request()->input('page', 1) - 1) * $warehouses->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouse = new Warehouse();
        return view('warehouse.create', compact('warehouse'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Warehouse::$rules);

        $warehouse = Warehouse::create($request->all());

        return redirect()->route('warehouses.index')
            ->with('success', 'Warehouse created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $warehouse = Warehouse::find($id);

        return view('warehouse.show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $warehouse = Warehouse::find($id);

        return view('warehouse.edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Warehouse $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        request()->validate(Warehouse::$rules);

        $warehouse->update($request->all());

        return redirect()->route('warehouses.index')
            ->with('success', 'Warehouse updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $warehouse = Warehouse::find($id)->delete();

        return redirect()->route('warehouses.index')
            ->with('success', 'Warehouse deleted successfully');
    }
}
