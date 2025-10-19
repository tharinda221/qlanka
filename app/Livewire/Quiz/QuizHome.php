<?php

namespace App\Livewire\Quiz;

use Livewire\Component;
use App\Models\QuizAttempt;

class QuizHome extends Component
{
    public $mobileNumber = '';
    public $name = '';
    public $city = '';
    public $showMobileModal = false;
    public $showRegistrationModal = false;
    public $existingUser = null;

    public function startQuiz()
    {
        // Check if user already has session data
        if (session()->has('quiz_user')) {
            // User already logged in, redirect to quiz
            return $this->redirect(route('quiz.play'));
        }
        
        // No session, show mobile modal
        $this->showMobileModal = true;
    }

    public function showMobileModal()
    {
        $this->showMobileModal = true;
    }

    public function checkMobile()
    {
        $this->validate([
            'mobileNumber' => 'required|string|min:10|max:10'
        ]);

        // Check if user exists in database
        $user = QuizAttempt::where('mobile', $this->mobileNumber)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($user) {
            // User exists, log them in and continue to quiz
            session([
                'quiz_user' => [
                    'name' => $user->name,
                    'mobile' => $user->mobile,
                    'city' => $user->city,
                ]
            ]);

            // Redirect to quiz
            return $this->redirect(route('quiz.play'));
        } else {
            // User doesn't exist, show registration form
            $this->showMobileModal = false;
            $this->showRegistrationModal = true;
        }
    }

    public function submitRegistration()
    {
        $this->validate([
            'name' => 'required|string|min:2|max:100',
            'mobileNumber' => 'required|string|min:10|max:10',
            'city' => 'required|string',
        ]);

        // Store user data in session
        session([
            'quiz_user' => [
                'name' => $this->name,
                'mobile' => $this->mobileNumber,
                'city' => $this->city,
            ]
        ]);

        // Redirect to quiz
        return $this->redirect(route('quiz.play'));
    }

    public function render()
    {
        return view('livewire.quiz.quiz-home', [
            'sessionData' => session('quiz_user', null)
        ])->layout('layouts.quiz');
    }
}
