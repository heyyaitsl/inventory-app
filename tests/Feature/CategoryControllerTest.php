<?php

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\call;

test('it creates a category', function () {
    $data = [ 'name' => 'Ropa' ];
    try{
        $this->post(route('categories.store'), $data);
        $this->assertDatabaseHas('categories', $data);
    }finally{
        Category::where('name', 'Ropa')->delete();
    }
});

test('it fails to create a category without name', function () {
    $data = [];
    $this->post(route('categories.store'), $data)->assertSessionHasErrors('name');

});

test('it reads a category', function () {
    $data = [ 'name' => 'Ropa' ];
    $category = Category::create($data);
    try {
        $this->get(route('categories.show', $category->id))->assertSee($data['name']);
    } finally {
        $category->delete();
    }

});

test('it lists categories', function () {
    $data = [ 'name' => 'Joyas' ];
    $category = Category::create($data);
    try {
        $this->get(route('categories.index'))->assertSee($data['name']);
    } finally {
        $category->delete();
    }
});

test('it updates a category', function () {
    $data = [ 'name' => 'Ropa' ];
    $category = Category::create($data);

    $dataUpdate = [ 'name' => 'Calzado' ];
    try {
        $this->patch(route('categories.update', $category->id), $dataUpdate);
        $this->assertDatabaseHas('categories', $dataUpdate);
    } finally {
        $category->delete();
    }
});

test('it deletes a category', function () {
    $data = [ 'name' => 'Aleatorio' ];
    $category = Category::create($data);
    $this->delete(route('categories.destroy', $category->id));
    $this->assertDatabaseMissing('categories', $data);
});