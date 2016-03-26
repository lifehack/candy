<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;

class ShopTableSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();

        Shop::create(array(
            'shop_name' => '雍和宫一店'
        ));

        Shop::create(array(
            'shop_name' => '日坛店',
        ));

        Shop::create(array(
            'shop_name' => '石景山',
        ));

        Shop::create(array(
            'shop_name' => '工体店',
        ));

        Shop::create(array(
            'shop_name' => '雍和宫二店',
        ));

        Shop::create(array(
            'shop_name' => '西单金库',
        ));
    }
}
