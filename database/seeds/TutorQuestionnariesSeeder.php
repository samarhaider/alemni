<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\Choice;

class TutorQuestionnariesSeeder extends Seeder
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
                'text' => 'Which of these do you find rewarding?',
                'type' => Question::FOR_TUTOR,
                'choices' => [
                    'Improving your students grades',
                    'Helping students get ahead',
                    'Giving a student confidence to succeed',
                    'Providing test prep',
                    'Teaching a hobby',
                ],
            ],
            [
                'text' => 'Do you have access to a car?',
                'type' => Question::FOR_TUTOR,
                'choices' => [
                    'Yes',
                    'No',
                ],
            ],
            [
                'text' => 'Are you interested in online tutoring?',
                'type' => Question::FOR_TUTOR,
                'choices' => [
                    'Yes',
                    'No',
                ],
            ],
            [
                'text' => 'Do your fee includes transportation cost?',
                'type' => Question::FOR_TUTOR,
                'choices' => [
                    'Yes',
                    'No',
                ],
            ],
            [
                'text' => 'How many years of tutoring experience do you have?',
                'type' => Question::FOR_TUTOR,
                'choices' => [
                    '0',
                    '1',
                    '2-4',
                    '5-10',
                    '10+',
                ],
            ],
            [
                'text' => 'Which type of students do you like to tutor?',
                'type' => Question::FOR_TUTOR,
                'choices' => [
                    'Elementary',
                    'Middle school',
                    'High school',
                    'College',
                    'Adult',
                ],
            ],
            [
                'text' => 'Where do you prefer having lessons?',
                'type' => Question::FOR_TUTOR,
                'choices' => [
                    'Students location',
                    'Library',
                    'Location I select',
                    'Online',
                ],
            ],
            [
                'text' => 'How many hours per week do you currently tutor outside of Alemni?',
                'type' => Question::FOR_TUTOR,
                'choices' => [
                    '0',
                    '1-5',
                    '6-10',
                    '11-20',
                    '21-35',
                    '35+',
                ],
            ],
            [
                'text' => 'Choose you subjects',
                'type' => Question::FOR_TUTOR,
                'choices' => [
                    'math',
                    'science',
                    'language',
                    'test preparation',
                    'elementary education',
                    'computer',
                    'business',
                    'history',
                    'music',
                    'special needs',
                    'sports/recreation',
                    'religion',
                    'art',
                ],
            ],
        ];
        // Loop through each user above and create the record for them in the database
        foreach ($questions as $key => $question) {
            $created_question = new Question;
            $created_question->text = $question['text'];
            $created_question->type = $question['type'];
            $created_question->save();
//            foreach ($question['choices'] as $key => $choice) {
//                $choice_data = new Choice;
//                $choice_data->text = $choice;
//                $created_question->choices()->save($choice_data);
//            }
        }

        Model::reguard();
    }
}
