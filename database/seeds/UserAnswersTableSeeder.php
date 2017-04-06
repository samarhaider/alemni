<?php

use Illuminate\Database\Seeder;

class UserAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Answer::class, 10)->create()->each(function ($a) {
        });
    }
}
