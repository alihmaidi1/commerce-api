<?php

namespace Database\Seeders;

use App\Models\currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class currencySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        currency::create([

            "code"=>"$",
            "value"=>1,
            "name"=>"USD"

        ]);


    }
}
