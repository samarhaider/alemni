<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\Choice;

class StudentQuestionnariesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $questions = [
            [
                'text' => 'What subject do you want to learn?',
                'type' => Question::FOR_STUDENT,
                'choices' => [
                    'Choose the subject',
                    'Enter District name',
                ],
            ],
            [
                'text' => 'What grade is the student in?',
                'type' => Question::FOR_STUDENT,
                'choices' => [
                    'Elementary',
                    'Middle school',
                    'High school',
                    'College',
                    'Adult',
                ],
            ],
            [
                'text' => 'When would you like to start lessons?',
                'type' => Question::FOR_STUDENT,
                'choices' => [
                    'Today',
                    'Within few weeks',
                    'Within two weeks',
                    'This month',
                ],
            ],
            [
                'text' => 'When are you available for lessons',
                'type' => Question::FOR_STUDENT,
                'choices' => [
                    'Days',
                    'Times',
                ],
            ],
            [
                'text' => 'Where would you like lessons to occur?',
                'type' => Question::FOR_STUDENT,
                'choices' => [
                    'At home',
                    'Library/public place',
                    'Coffee shop',
                    'Tutor\'s location',
                    'Online',
                ],
            ],
            [
                'text' => 'How often do you expect to meet with tutor?',
                'type' => Question::FOR_STUDENT,
                'choices' => [
                    'Just once',
                    'A few times',
                    'Regular schedule',
                    'I am not sure',
                    'No',
                ],
            ],
            [
                'text' => 'What do you plan to accomplish with tutoring?',
                'type' => Question::FOR_STUDENT,
                'choices' => [
                    'Improve grades',
                    'Get ahead',
                    'Increase confidence',
                    'Prepare for a test',
                    'Learn a new skill',
                ],
            ],
        ];
        // Loop through each user above and create the record for them in the database
        foreach ($questions as $key => $question) {
            $created_question = new Question;
            $created_question->text = $question['text'];
            $created_question->type = $question['type'];
            $created_question->save();
            foreach ($question['choices'] as $key => $choice) {
                $choice_data = new Choice;
                $choice_data->text = $choice;
                $created_question->choices()->save($choice_data);
            }
        }

        Model::reguard();
    }
}
