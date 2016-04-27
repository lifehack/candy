<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\models\Shop;

class ShopTableSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();

        Shop::create(array(
            'shop_name' => '雍和宫1店',
            'shop_tel' => '010-1'

        ));

        Shop::create(array(
            'shop_name' => '日坛店',
            'shop_tel' => '010-2'
        ));

        Shop::create(array(
            'shop_name' => '石景山店',
            'shop_tel' => '010-3'
        ));

        Shop::create(array(
            'shop_name' => '工体店',
            'shop_tel' => '010-4'
        ));

        Shop::create(array(
            'shop_name' => '雍和宫2店',
            'shop_tel' => '010-5'
        ));

        Shop::create(array(
            'shop_name' => '西单店',
            'shop_tel' => '010-6'
        ));
    }
}
