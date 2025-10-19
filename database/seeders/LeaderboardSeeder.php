<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuizAttempt;
use Carbon\Carbon;

class LeaderboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dummyUsers = [
            ['name' => 'Davis Curtis', 'mobile' => '0771234567', 'city' => 'Colombo'],
            ['name' => 'Alena Donin', 'mobile' => '0771234568', 'city' => 'Kandy'],
            ['name' => 'Craig Gouse', 'mobile' => '0771234569', 'city' => 'Galle'],
            ['name' => 'Madelyn Dias', 'mobile' => '0771234570', 'city' => 'Negombo'],
            ['name' => 'Zain Vaccaro', 'mobile' => '0771234571', 'city' => 'Jaffna'],
            ['name' => 'Sarah Johnson', 'mobile' => '0771234572', 'city' => 'Anuradhapura'],
            ['name' => 'Michael Brown', 'mobile' => '0771234573', 'city' => 'Trincomalee'],
            ['name' => 'Emma Wilson', 'mobile' => '0771234574', 'city' => 'Batticaloa'],
            ['name' => 'James Davis', 'mobile' => '0771234575', 'city' => 'Ratnapura'],
            ['name' => 'Olivia Taylor', 'mobile' => '0771234576', 'city' => 'Kurunegala'],
            ['name' => 'William Anderson', 'mobile' => '0771234577', 'city' => 'Polonnaruwa'],
            ['name' => 'Sophia Martinez', 'mobile' => '0771234578', 'city' => 'Badulla'],
            ['name' => 'Benjamin Thompson', 'mobile' => '0771234579', 'city' => 'Monaragala'],
            ['name' => 'Isabella Garcia', 'mobile' => '0771234580', 'city' => 'Hambantota'],
            ['name' => 'Lucas Rodriguez', 'mobile' => '0771234581', 'city' => 'Matara'],
            ['name' => 'Charlotte Lee', 'mobile' => '0771234582', 'city' => 'Kalutara'],
            ['name' => 'Henry White', 'mobile' => '0771234583', 'city' => 'Chilaw'],
            ['name' => 'Amelia Harris', 'mobile' => '0771234584', 'city' => 'Puttalam'],
            ['name' => 'Alexander Clark', 'mobile' => '0771234585', 'city' => 'Mannar'],
            ['name' => 'Mia Lewis', 'mobile' => '0771234586', 'city' => 'Vavuniya'],
        ];

        foreach ($dummyUsers as $index => $user) {
            // Create 1-3 attempts per user with varying scores
            $attemptsCount = rand(1, 3);
            
            for ($i = 0; $i < $attemptsCount; $i++) {
                $totalQuestions = 10; // Assuming 10 questions per quiz
                
                // Vary the scores - better players get higher scores
                $baseScore = $totalQuestions - $index; // Better ranking = higher base score
                $score = max(0, min($totalQuestions, $baseScore + rand(-2, 2)));
                
                $timeTaken = rand(60, 300); // 1-5 minutes
                $completedAt = Carbon::now()->subDays(rand(0, 30))->subHours(rand(0, 23));
                
                QuizAttempt::create([
                    'name' => $user['name'],
                    'mobile' => $user['mobile'],
                    'city' => $user['city'],
                    'score' => $score,
                    'total_questions' => $totalQuestions,
                    'correct_answers' => $score,
                    'time_taken' => $timeTaken,
                    'started_at' => $completedAt->subMinutes(rand(1, 5)),
                    'completed_at' => $completedAt,
                ]);
            }
        }
    }
}
