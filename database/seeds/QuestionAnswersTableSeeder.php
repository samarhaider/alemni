<?php
use Illuminate\Database\Seeder;

class QuestionAnswersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Question::class, 15)->create()->each(function ($a) {
            $a->choices()->save(factory(App\Models\Choice::class)->make());
            $a->choices()->save(factory(App\Models\Choice::class)->make());
            $a->choices()->save(factory(App\Models\Choice::class)->make());
            $a->choices()->save(factory(App\Models\Choice::class)->make());
            $a->choices()->save(factory(App\Models\Choice::class)->make());
        });
    }
}
