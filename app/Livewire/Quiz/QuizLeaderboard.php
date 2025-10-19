<?php

namespace App\Livewire\Quiz;

use App\Models\QuizAttempt;
use Livewire\Component;

class QuizLeaderboard extends Component
{

    public $sortBy = 'percentage';
    public $sortDirection = 'desc';
    public $filterBy = 'all'; // all, today, week, month

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function filterBy($period)
    {
        $this->filterBy = $period;
    }

    public function render()
    {
        // Get all completed attempts
        $attempts = QuizAttempt::whereNotNull('completed_at')->get();
        
        // Group by mobile number to get unique participants
        $participants = $attempts->groupBy('mobile')->map(function ($userAttempts) {
            $bestScore = $userAttempts->max('score');
            $totalQuestions = $userAttempts->first()->total_questions;
            $bestPercentage = $bestScore ? round(($bestScore / $totalQuestions) * 100, 1) : 0;
            
            return (object) [
                'name' => $userAttempts->first()->name,
                'mobile' => $userAttempts->first()->mobile,
                'city' => $userAttempts->first()->city,
                'best_percentage' => $bestPercentage,
                'total_attempts' => $userAttempts->count(),
                'average_percentage' => round($userAttempts->avg(function($attempt) {
                    return ($attempt->score / $attempt->total_questions) * 100;
                }), 1),
                'best_score' => $bestScore,
                'best_time' => $userAttempts->min('time_taken'),
                'last_attempt' => $userAttempts->max('completed_at'),
            ];
        })->filter(function($participant) {
            // Filter out participants with invalid data
            return !empty($participant->name) && !empty($participant->mobile);
        });

        // Sort by best percentage (descending) for leaderboard
        $participants = $participants->sortByDesc('best_percentage')->values();

        // Calculate user's rank and percentile
        $userRank = null;
        $userPercentile = 0;
        
        if (session('quiz_user')) {
            $userMobile = session('quiz_user.mobile');
            $userIndex = $participants->search(function($participant) use ($userMobile) {
                return $participant->mobile === $userMobile;
            });
            
            if ($userIndex !== false) {
                $userRank = $userIndex + 1;
                $totalParticipants = $participants->count();
                $userPercentile = round((($totalParticipants - $userIndex) / $totalParticipants) * 100);
            }
        }

        // Get statistics
        $stats = [
            'total_participants' => $participants->count(),
            'total_attempts' => $attempts->count(),
            'average_score' => $attempts->avg(function($attempt) {
                return ($attempt->score / $attempt->total_questions) * 100;
            }) ?? 0,
            'highest_score' => $attempts->max(function($attempt) {
                return ($attempt->score / $attempt->total_questions) * 100;
            }) ?? 0,
        ];

        return view('livewire.quiz.quiz-leaderboard', [
            'leaderboard' => $participants,
            'top3' => $participants->take(3),
            'rest' => $participants->slice(3)->take(7)->values(),
            'stats' => $stats,
            'userRank' => $userRank,
            'userPercentile' => $userPercentile,
        ])->layout('layouts.quiz');
    }
}