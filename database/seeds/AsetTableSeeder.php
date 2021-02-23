<?php

use Illuminate\Database\Seeder;

class AsetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // factory(App\Aset::class, 50)->create();
        factory(App\Aset::class, 50)->create();
    }
}
