<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {

        \App\Models\Category::factory(10)->create();
        \App\Models\Product::factory(50)->create();
        \App\Models\Warehouse::factory(10)->create();
        \App\Models\ProductHasWarehouse::factory(100)->create();
        
    
    }
}
