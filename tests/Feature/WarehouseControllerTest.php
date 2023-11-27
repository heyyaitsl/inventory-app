<?php

use App\Models\Warehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\call;

test('it creates a warehouse', function () {
    $data = [ 'name' => 'Ropa' ];
    $this->post(route('warehouses.store'), $data);
    try {
        $this->assertDatabaseHas('warehouses', $data);
    } finally {
        Warehouse::where('name', 'Ropa')->delete();
    }
});

test('it fails to create a warehouses without name', function () {
    $data = [];
    $this->post(route('warehouses.store'), $data)->assertSessionHasErrors('name');


});

test('it reads a warehouse', function () {
    $data = [ 'name' => 'Ropa' ];
    $warehouse = Warehouse::create($data);
    try {
        $this->get(route('warehouses.show', $warehouse->id))->assertSee($data['name']);
    } finally {
        $warehouse->delete();
    }
});

test('it lists warehouses', function () {
    $data = [ 'name' => 'Joyas' ];
    $warehouse = Warehouse::create($data);
    try {
        $this->get(route('warehouses.index'))->assertSee($data['name']);
    } finally {
        $warehouse->delete();
    }
});


test('it updates a warehouse', function () {
    $data = [ 'name' => 'Ropa' ];
    $warehouse = Warehouse::create($data);
    $dataUpdate = [ 'name' => 'Calzado' ];
    try{
        $this->patch(route('warehouses.update', $warehouse->id), $dataUpdate);
        $this->assertDatabaseHas('warehouses', $dataUpdate);
    }finally {
        $warehouse->delete();
    }

});

test('it deletes a warehouse', function () {
    $data = [ 'name' => 'Aleatorio' ];
    $warehouse = Warehouse::create($data);
    $this->delete(route('warehouses.destroy', $warehouse->id));
    $this->assertDatabaseMissing('warehouses', $data);
});