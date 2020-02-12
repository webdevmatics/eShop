<?php

use Illuminate\Database\Seeder;

class AllTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create(['email'=>'admin@ecom.com']);
        factory(App\Shop::class)->create(['name'=>'LNshop']);


        factory(App\Category::class, 10)->create();


        factory(App\Product::class, 20)->create();

    }
}
