<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;

class PackageTableSeeder extends Seeder
{

    public function run()
    {

        Eloquent::unguard();

        Package::create(array(
            'package_name' => '雍和宫店一店',
            'package_price' => '135',
            'package_time' => '8',
            'package_description' => 'This is the first package and a description of it'
        ));

        Package::create(array(
            'package_name' => '工体店',
            'package_price' => '175',
            'package_time' => '2',
            'package_description' => 'This is the second package and a description of it'
        ));

        Package::create(array(
            'package_name' => '石景山',
            'package_price' => '175',
            'package_time' => '2',
            'package_description' => 'This is the second package and a description of it'
        ));

        Package::create(array(
            'package_name' => '日坛店',
            'package_price' => '175',
            'package_time' => '2',
            'package_description' => 'This is the second package and a description of it'
        ));

        Package::create(array(
            'package_name' => '雍和宫二店',
            'package_price' => '175',
            'package_time' => '2',
            'package_description' => 'This is the second package and a description of it'
        ));
    }
}
