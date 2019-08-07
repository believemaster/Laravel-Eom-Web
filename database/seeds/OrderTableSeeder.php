<?php

use App\Order;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::create([
            'user_id' => 1,
            'date' => Carbon::today(),
            'address' => '5/E-3 Shyam Vihar Ph-2, IN',
            'status' => 1,
        ]);

        Order::create([
            'user_id' => 1,
            'date' => Carbon::today(),
            'address' => '5/E-3 Najafgarh Shyam Vihar Ph-1, IN',
            'status' => 1
        ]);

        Order::create([
            'user_id' => 2,
            'date' => Carbon::today(),
            'address' => 'A-11/2A SV New Delhi, IN',
            'status' => 1
        ]);
    }
}
