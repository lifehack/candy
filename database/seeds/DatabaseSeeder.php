<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call('ShopTableSeeder');
        $this->command->info('Shop table seeded!');

        $this->call('BookingDateTimeTableSeeder');
        $this->command->info('Booking DateTimes seeded!');

        $this->call('CustomerSeeder');
        $this->command->info('Customers seeded!');

        $this->call('AppointmentSeeder');
        $this->command->info('Appointments seeded!');

        $this->call('AdminSeeder');
        $this->command->info('Admins seeded!');

        Eloquent::unguard();
    }

}
