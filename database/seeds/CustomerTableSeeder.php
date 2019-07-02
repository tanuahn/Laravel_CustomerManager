<?php

use App\Customer;
use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $dataArray = [];
//        for ($i = 0; $i < 20; $i++){
//            array_push($dataArray, [
//                'name' => str_random(10),
//                'dob' => date("Y-m-d", mt_rand(1, time())),
//                'email' => str_random(10) . '@gmail.com',
//                'created_at' => date('Y-m-d H:i:s'),
//                'updated_at' => date('Y-m-d H:i:s')
//            ]);
//            DB::table('customer')->insert($dataArray);
//        }
        $customer = new Customer();
        $customer->id   = 1;
        $customer->name = "customer 1";
        $customer->dob  = "2018-09-26";
        $customer->email  = "customer1@codegym.vn";
        $customer->city_id  = 1;
        $customer->save();
        $customer = new Customer();
        $customer->id   = 2;
        $customer->name = "customer 2";
        $customer->dob  = "2018-09-26";
        $customer->email  = "customer2@codegym.vn";
        $customer->city_id  = 1;
        $customer->save();
        $customer = new Customer();
        $customer->id   = 3;
        $customer->name = "customer 3";
        $customer->dob  = "2018-09-26";
        $customer->email  = "customer3@codegym.vn";
        $customer->city_id  = 2;
        $customer->save();
    }
}
