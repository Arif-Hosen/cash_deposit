<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::create([
            'name' => 'bkash agent',
            'user_id' => '1',
            'mobile' => '01860842421',
            'status' => Payment::$statusArray[0],
        ]);
       Payment::create([
            'name' => 'bkash personal',
            'user_id' => '1',
            'mobile' => '01860842422',
            'status' => Payment::$statusArray[0],
        ]);
    }
}
