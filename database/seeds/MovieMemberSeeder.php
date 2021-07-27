<?php

use Illuminate\Database\Seeder;

class MovieMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Movie::class, 10)->create();
        factory(\App\Models\Member::class, 10)->create();
    }
}
