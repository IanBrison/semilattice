<?php

use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Type::create(['type_num' => 1]);
        \App\Type::create(['type_num' => 2]);
        \App\Type::create(['type_num' => 3]);
        \App\Type::create(['type_num' => 4]);
    }
}
