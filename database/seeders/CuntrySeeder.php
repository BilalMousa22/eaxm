<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CuntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Cuntry::factory(50)->create();

    }
}
