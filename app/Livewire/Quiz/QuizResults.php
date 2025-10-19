<?php

namespace App\Livewire\Quiz;

use App\Models\QuizAttempt;
use Livewire\Component;

class QuizResults extends Component
{
    public $quizAttempt;
    public $percentage;
    public $grade;

    public function mount($id)
    {
        try {
            $this->quizAttempt = QuizAttempt::findOrFail($id);
            $this->percentage = $this->quizAttempt->percentage;
            $this->grade = $this->getGrade($this->percentage);
        } catch (\Exception $e) {
            // If quiz attempt not found, redirect to home
            return $this->redirect(route('home'));
        }
    }

    private function getGrade($percentage)
    {
        if ($percentage >= 90) return 'A+';
        if ($percentage >= 80) return 'A';
        if ($percentage >= 70) return 'B+';
        if ($percentage >= 60) return 'B';
        if ($percentage >= 50) return 'C+';
        if ($percentage >= 40) return 'C';
        return 'F';
    }

    public function render()
    {
        return view('livewire.quiz.quiz-results')
            ->layout('layouts.quiz');
    }
}