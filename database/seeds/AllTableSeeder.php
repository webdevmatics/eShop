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
        $admin = factory(App\User::class)->create(['email'=>'admin@ecom.com','role'=>'admin']);
        $seller = factory(App\User::class)->create(['email'=>'seller@ecom.com', 'role'=>'seller']);
        factory(App\User::class)->create(['email'=>'customer@ecom.com','role'=>'customer']);

        factory(App\Shop::class)->create(['name'=>'ecom-shop','user_id'=>$admin->id]);
        factory(App\Shop::class)->create(['name'=>'seller-shop','user_id'=>$seller->id]);

        factory(App\Category::class, 10)->create();

        factory(App\Product::class, 20)->create();

    }
}
