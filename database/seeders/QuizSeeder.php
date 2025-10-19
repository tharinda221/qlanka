<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample Question 1: Programming
        $question1 = Question::create([
            'question' => 'What does HTML stand for?'
        ]);

        Answer::create(['question_id' => $question1->id, 'answer' => 'HyperText Markup Language', 'is_correct' => true]);
        Answer::create(['question_id' => $question1->id, 'answer' => 'High Tech Modern Language', 'is_correct' => false]);
        Answer::create(['question_id' => $question1->id, 'answer' => 'Home Tool Markup Language', 'is_correct' => false]);
        Answer::create(['question_id' => $question1->id, 'answer' => 'Hyperlink and Text Markup Language', 'is_correct' => false]);

        // Sample Question 2: Geography
        $question2 = Question::create([
            'question' => 'What is the capital city of Japan?'
        ]);

        Answer::create(['question_id' => $question2->id, 'answer' => 'Tokyo', 'is_correct' => true]);
        Answer::create(['question_id' => $question2->id, 'answer' => 'Osaka', 'is_correct' => false]);
        Answer::create(['question_id' => $question2->id, 'answer' => 'Kyoto', 'is_correct' => false]);
        Answer::create(['question_id' => $question2->id, 'answer' => 'Hiroshima', 'is_correct' => false]);

        // Sample Question 3: Science
        $question3 = Question::create([
            'question' => 'What is the chemical symbol for gold?'
        ]);

        Answer::create(['question_id' => $question3->id, 'answer' => 'Au', 'is_correct' => true]);
        Answer::create(['question_id' => $question3->id, 'answer' => 'Go', 'is_correct' => false]);
        Answer::create(['question_id' => $question3->id, 'answer' => 'Gd', 'is_correct' => false]);
        Answer::create(['question_id' => $question3->id, 'answer' => 'Ag', 'is_correct' => false]);

        // Sample Question 4: History
        $question4 = Question::create([
            'question' => 'In which year did World War II end?'
        ]);

        Answer::create(['question_id' => $question4->id, 'answer' => '1945', 'is_correct' => true]);
        Answer::create(['question_id' => $question4->id, 'answer' => '1944', 'is_correct' => false]);
        Answer::create(['question_id' => $question4->id, 'answer' => '1946', 'is_correct' => false]);
        Answer::create(['question_id' => $question4->id, 'answer' => '1943', 'is_correct' => false]);

        // Sample Question 5: Technology
        $question5 = Question::create([
            'question' => 'Which company developed the iPhone?'
        ]);

        Answer::create(['question_id' => $question5->id, 'answer' => 'Apple', 'is_correct' => true]);
        Answer::create(['question_id' => $question5->id, 'answer' => 'Samsung', 'is_correct' => false]);
        Answer::create(['question_id' => $question5->id, 'answer' => 'Google', 'is_correct' => false]);
        Answer::create(['question_id' => $question5->id, 'answer' => 'Microsoft', 'is_correct' => false]);

        // Sample Question 6: Sports
        $question6 = Question::create([
            'question' => 'How many players are on a basketball team on the court at one time?'
        ]);

        Answer::create(['question_id' => $question6->id, 'answer' => '5', 'is_correct' => true]);
        Answer::create(['question_id' => $question6->id, 'answer' => '6', 'is_correct' => false]);
        Answer::create(['question_id' => $question6->id, 'answer' => '4', 'is_correct' => false]);
        Answer::create(['question_id' => $question6->id, 'answer' => '7', 'is_correct' => false]);

        // Sample Question 7: Literature
        $question7 = Question::create([
            'question' => 'Who wrote the novel "1984"?'
        ]);

        Answer::create(['question_id' => $question7->id, 'answer' => 'George Orwell', 'is_correct' => true]);
        Answer::create(['question_id' => $question7->id, 'answer' => 'Aldous Huxley', 'is_correct' => false]);
        Answer::create(['question_id' => $question7->id, 'answer' => 'Ray Bradbury', 'is_correct' => false]);
        Answer::create(['question_id' => $question7->id, 'answer' => 'H.G. Wells', 'is_correct' => false]);

        // Sample Question 8: Math
        $question8 = Question::create([
            'question' => 'What is the square root of 64?'
        ]);

        Answer::create(['question_id' => $question8->id, 'answer' => '8', 'is_correct' => true]);
        Answer::create(['question_id' => $question8->id, 'answer' => '6', 'is_correct' => false]);
        Answer::create(['question_id' => $question8->id, 'answer' => '7', 'is_correct' => false]);
        Answer::create(['question_id' => $question8->id, 'answer' => '9', 'is_correct' => false]);
    }
}
