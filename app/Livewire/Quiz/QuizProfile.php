<?php

namespace App\Livewire\Quiz;

use Livewire\Component;
use App\Models\QuizAttempt;
use App\Models\QuizAnswer;
use Illuminate\Support\Facades\DB;

class QuizProfile extends Component
{
    public $userData;
    public $quizAttempts = [];
    public $bestScore = 0;
    public $totalAttempts = 0;
    public $averageScore = 0;
    public $totalTimeSpent = 0;
    public $recentAttempts = [];

    public function mount()
    {
        // Check if user is registered
        if (!session()->has('quiz_user')) {
            // Store intended URL for redirect after registration
            session(['intended_url' => route('quiz.profile')]);
            return $this->redirect(route('home'));
        }

        $this->userData = session('quiz_user');
        $this->loadUserStats();
    }

    public function loadUserStats()
    {
        $mobile = $this->userData['mobile'];
        
        // Get all quiz attempts for this user
        $this->quizAttempts = QuizAttempt::where('mobile', $mobile)
            ->orderBy('created_at', 'desc')
            ->get();

        $this->totalAttempts = $this->quizAttempts->count();
        
        if ($this->totalAttempts > 0) {
            // Calculate best score
            $this->bestScore = $this->quizAttempts->max('score');
            
            // Calculate average score
            $this->averageScore = round($this->quizAttempts->avg('score'), 1);
            
            // Calculate total time spent (in minutes)
            $this->totalTimeSpent = round($this->quizAttempts->sum('time_taken') / 60, 1);
            
            // Get recent attempts (last 5)
            $this->recentAttempts = $this->quizAttempts->take(5);
        }
    }

    public function clearSession()
    {
        session()->forget('quiz_user');
        return $this->redirect(route('home'));
    }

    public function render()
    {
        return view('livewire.quiz.quiz-profile')
            ->layout('layouts.quiz');
    }
}
