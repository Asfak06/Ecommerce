<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // factory(\App\Product::class, 30)->create();     
          \App\Models\Product::factory(30)->create();   
    }
}
