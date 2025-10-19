<?php

namespace App\Livewire\Quiz;

use App\Models\Question;
use App\Models\Answer;
use App\Models\QuizAttempt;
use App\Models\QuizAnswer;
use Livewire\Component;
use Carbon\Carbon;

class QuizInterface extends Component
{
    public $questions = [];
    public $currentQuestionIndex = 0;
    public $selectedAnswer = null;
    public $timeRemaining = 120; // 2 minutes in seconds
    public $quizStarted = false;
    public $quizCompleted = false;
    public $userAnswers = [];
    public $correctAnswers = [];
    public $quizAttempt = null;
    public $questionStartTime = null;
    public $showFeedback = false;
    public $feedbackMessage = '';
    public $feedbackType = ''; // 'correct' or 'incorrect'

    protected $listeners = ['timerTick'];

    public function mount()
    {
        // Check if user is registered
        if (!session()->has('quiz_user')) {
            return $this->redirect(route('home'));
        }

        // Load 5 random questions
        $this->questions = Question::with('answers')->inRandomOrder()->limit(5)->get()->toArray();
        
        if (empty($this->questions)) {
            session()->flash('error', 'No questions available. Please contact administrator.');
            return $this->redirect(route('home'));
        }

        // Initialize arrays
        $this->userAnswers = array_fill(0, count($this->questions), null);
        $this->correctAnswers = array_fill(0, count($this->questions), null);

        // Automatically start the quiz since user came from registration
        $this->quizStarted = true;
        $this->questionStartTime = now();
        
        // Create quiz attempt record
        $userData = session('quiz_user');
        $this->quizAttempt = QuizAttempt::create([
            'name' => $userData['name'],
            'mobile' => $userData['mobile'],
            'city' => $userData['city'],
            'total_questions' => count($this->questions),
            'started_at' => now(),
        ]);

        // Start timer
        $this->dispatch('startTimer');
    }

    public function handleRegistration()
    {
        $request = request();
        
        // Validate the data
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:100',
            'mobile' => 'required|string|min:10|max:10',
            'city' => 'required|string',
        ]);

        // Store user data in session
        session([
            'quiz_user' => [
                'name' => $validated['name'],
                'mobile' => $validated['mobile'],
                'city' => $validated['city'],
            ]
        ]);

        // Check if there's an intended URL to redirect to
        $intendedUrl = session('intended_url');
        if ($intendedUrl) {
            session()->forget('intended_url');
            return $this->redirect($intendedUrl);
        }

        // Default redirect to quiz play page
        return $this->redirect(route('quiz.play'));
    }

    public function handleRegister()
    {
        $request = request();
        
        // Validate the data
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:100',
            'mobile' => 'required|string|min:10|max:10',
            'city' => 'required|string',
        ]);

        // Store user data in session
        session([
            'quiz_user' => [
                'name' => $validated['name'],
                'mobile' => $validated['mobile'],
                'city' => $validated['city'],
            ]
        ]);

        // Check if there's an intended URL to redirect to
        $intendedUrl = session('intended_url');
        if ($intendedUrl) {
            session()->forget('intended_url');
            // Debug: Log the intended URL
            \Log::info('Redirecting to intended URL: ' . $intendedUrl);
            return $this->redirect($intendedUrl);
        }

        // Default redirect to quiz play page
        return $this->redirect(route('quiz.play'));
    }

    public function startQuiz()
    {
        $this->quizStarted = true;
        $this->questionStartTime = now();
        
        // Create quiz attempt record
        $userData = session('quiz_user');
        $this->quizAttempt = QuizAttempt::create([
            'name' => $userData['name'],
            'mobile' => $userData['mobile'],
            'city' => $userData['city'],
            'total_questions' => count($this->questions),
            'started_at' => now(),
        ]);

        // Start timer
        $this->dispatch('startTimer');
    }

    public function selectAnswer($answerId)
    {
        if (!$this->quizStarted || $this->showFeedback) {
            return;
        }

        $this->selectedAnswer = $answerId;
        $this->userAnswers[$this->currentQuestionIndex] = $answerId;

        // Find the correct answer for current question
        $currentQuestion = $this->questions[$this->currentQuestionIndex];
        $correctAnswer = collect($currentQuestion['answers'])->where('is_correct', true)->first();
        $this->correctAnswers[$this->currentQuestionIndex] = $correctAnswer['id'];

        // Show feedback
        $this->showFeedback = true;
        if ($answerId == $correctAnswer['id']) {
            $this->feedbackMessage = 'Correct! 🎉';
            $this->feedbackType = 'correct';
        } else {
            $this->feedbackMessage = 'Incorrect! The correct answer was: ' . $correctAnswer['answer'];
            $this->feedbackType = 'incorrect';
        }

        // Record the answer
        $this->recordAnswer($answerId, $answerId == $correctAnswer['id']);

        // Auto-advance after 2 seconds
        $this->dispatch('showFeedback');
    }

    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < count($this->questions) - 1) {
            $this->currentQuestionIndex++;
            $this->selectedAnswer = null;
            $this->showFeedback = false;
            $this->questionStartTime = now();
        } else {
            $this->completeQuiz();
        }
    }

    public function completeQuiz()
    {
        $this->quizCompleted = true;
        
        // Calculate score
        $correctCount = 0;
        foreach ($this->userAnswers as $index => $userAnswer) {
            if ($userAnswer == $this->correctAnswers[$index]) {
                $correctCount++;
            }
        }

        // Update quiz attempt
        $this->quizAttempt->update([
            'correct_answers' => $correctCount,
            'score' => $correctCount,
            'time_taken' => 120 - $this->timeRemaining,
            'completed_at' => now(),
        ]);

        // Redirect to results
        return $this->redirect(route('quiz.results', $this->quizAttempt->id));
    }

    public function timerTick()
    {
        if ($this->quizStarted && !$this->quizCompleted) {
            $this->timeRemaining--;
            
            if ($this->timeRemaining <= 0) {
                $this->completeQuiz();
            }
        }
    }

    private function recordAnswer($answerId, $isCorrect)
    {
        if ($this->quizAttempt) {
            QuizAnswer::create([
                'quiz_attempt_id' => $this->quizAttempt->id,
                'question_id' => $this->questions[$this->currentQuestionIndex]['id'],
                'answer_id' => $answerId,
                'is_correct' => $isCorrect,
                'time_taken' => $this->questionStartTime ? now()->diffInSeconds($this->questionStartTime) : 0,
            ]);
        }
    }

    public function getProgressPercentage()
    {
        if ($this->quizCompleted) {
            return 100;
        }
        
        // Count only questions that have been answered
        $questionsAnswered = 0;
        for ($i = 0; $i < count($this->questions); $i++) {
            if ($this->userAnswers[$i] !== null) {
                $questionsAnswered++;
            }
        }
        
        return round(($questionsAnswered / count($this->questions)) * 100);
    }

    public function getFormattedTime()
    {
        $minutes = floor($this->timeRemaining / 60);
        $seconds = $this->timeRemaining % 60;
        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    public function render()
    {
        return view('livewire.quiz.quiz-interface')
            ->layout('layouts.quiz');
    }
}