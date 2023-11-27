<?php

use App\Models\Product;
use App\Models\Category;

test('it creates a product', function () {
    $category = Category::create([ 'name' => 'Ropa' ]);
    $data = [ 'name' => 'Ropa',
        'price' => 1000,
        'observations' => 'Ropa es un ropa',
        'category_id' => $category->id];
    try{
        $this->post(route('products.store'), $data);
        $this->assertDatabaseHas('products', $data);
    }finally{
        Product::where($data)->delete();
        $category->delete();
    }
});

test('it fails to create a product without name', function () {
    $category = Category::create([ 'name' => 'Ropa' ]);
    $data = [ 'price' => 1000,
        'observations' => 'Ropa es un ropa',
        'category_id' => $category->id];
    try{
        $this->post(route('products.store'), $data)->assertSessionHasErrors('name');
    }finally{
        $category->delete();
    }

});

test('it reads a product', function () {
    $category = Category::create([ 'name' => 'Ropa' ]);
    $data = [ 'name' => 'Ropa',
        'price' => 1000,
        'observations' => 'Ropa es un ropa',
        'category_id' => $category->id];
    $product = product::create($data);
    try {
        $this->get(route('products.show', $product->id))->assertSee($data['name']);
    } finally {
        $product->delete();
        $category->delete();
    }

});

test('it lists products', function () {
    $category = Category::create([ 'name' => 'Ropa' ]);
    $data = [ 'name' => 'Ropa',
        'price' => 1000,
        'observations' => 'Ropa es un ropa',
        'category_id' => $category->id];
    $product = product::create($data);
    try {
        
        $perPage = 20;
        $totalPages = ceil(Product::count() / $perPage);
        for ($page = 1; $page <= $totalPages; $page++) {

            $response = $this->get(route('products.index', ['page' => $page]));

            if (strpos($response->getContent(), $data['name']) !== false) {
                $this->assertTrue(true);
                break; 
            }

        }

    } finally {
        $product->delete();
        $category->delete();
    }
});

test('it updates a product', function () {
    $category = Category::create([ 'name' => 'Ropa' ]);
    $data = [ 'name' => 'Ropa',
        'price' => 1000,
        'observations' => 'Ropa es un ropa',
        'category_id' => $category->id];
    $product = product::create($data);

    $dataUpdate = [ 'name' => 'Ropa',
                    'price' => 1000,
                    'observations' => 'No es un ropa',
                    'category_id' => $category->id];
    try {
        $this->patch(route('products.update', $product->id), $dataUpdate);
        $this->assertDatabaseHas('products', $dataUpdate);
    } finally {
        $product->delete();
        $category->delete();
    }
});

test('it deletes a product', function () {
    $category = Category::create([ 'name' => 'Ropa' ]);
    $data = [ 'name' => 'Ropa',
        'price' => 1000,
        'observations' => 'Ropa es un ropa',
        'category_id' => $category->id];
    $product = product::create($data);
    try {
        $this->delete(route('products.destroy', $product->id));
        $this->assertDatabaseMissing('products', $data);
    } finally {
        $category->delete();
    }
});