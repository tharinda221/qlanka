<?php

namespace App\Livewire\Quiz;

use Livewire\Component;
use App\Models\QuizAttempt;
use App\Models\QuizAnswer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class QuizProfile extends Component
{
    public $userData;
    public $bestScore = 0;
    public $totalAttempts = 0;
    public $averageScore = 0;
    public $totalTimeSpent = 0;
    public $recentAttempts = [];
    public $showUnsubscribeModal = false;
    public $unsubscribeMobile = '';
    public $unsubscribeError = '';

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
        $quizAttempts = QuizAttempt::where('mobile', $mobile)
            ->orderBy('created_at', 'desc')
            ->get();

        $this->totalAttempts = $quizAttempts->count();
        
        if ($this->totalAttempts > 0) {
            // Calculate best score
            $this->bestScore = $quizAttempts->max('score');
            
            // Calculate average score
            $this->averageScore = round($quizAttempts->avg('score'), 1);
            
            // Calculate total time spent (in minutes)
            $this->totalTimeSpent = round($quizAttempts->sum('time_taken') / 60, 1);
            
            // Get recent attempts (last 5) and convert to array
            $this->recentAttempts = $quizAttempts->take(5)->toArray();
        } else {
            $this->recentAttempts = [];
        }
    }

    public function clearSession()
    {
        session()->forget('quiz_user');
        return $this->redirect(route('home'));
    }

    public function showUnsubscribeModal()
    {
        $this->showUnsubscribeModal = true;
        $this->unsubscribeMobile = '';
        $this->unsubscribeError = '';
    }

    public function closeUnsubscribeModal()
    {
        $this->showUnsubscribeModal = false;
        $this->unsubscribeMobile = '';
        $this->unsubscribeError = '';
    }

    public function submitUnsubscribe()
    {
        // Validate mobile number
        $this->validate([
            'unsubscribeMobile' => [
                'required',
                'string',
                'regex:/^0[0-9]{9}$/',
                'size:10'
            ],
        ], [
            'unsubscribeMobile.required' => 'Please enter your mobile number',
            'unsubscribeMobile.regex' => 'Mobile number must start with 0 and be exactly 10 digits',
            'unsubscribeMobile.size' => 'Mobile number must be exactly 10 digits',
        ]);

        // Reset error
        $this->unsubscribeError = '';

        try {
            // Call the unsubscribe API
            $response = Http::timeout(30)->get('https://myapplanka.com/PrashnaOnline/web/unSubscribeUser', [
                'phone' => $this->unsubscribeMobile
            ]);

            // Log the response for debugging
            Log::info('Unsubscribe API Response:', [
                'phone' => $this->unsubscribeMobile,
                'status_code' => $response->status(),
                'response_body' => $response->body(),
                'response_json' => $response->json()
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['status']) && $data['status'] === 'SUCCESS') {
                    // Unsubscribe successful
                    // Clear session and redirect to home
                    session()->forget('quiz_user');
                    session()->flash('message', 'You have been successfully unsubscribed.');
                    
                    return $this->redirect(route('home'));
                } else {
                    // Unsubscribe failed
                    $this->unsubscribeError = 'Unsubscribe failed. Please try again or contact support.';
                }
            } else {
                $this->unsubscribeError = 'Unable to connect to unsubscribe service. Please try again.';
            }

        } catch (\Exception $e) {
            Log::error('Unsubscribe Exception:', [
                'phone' => $this->unsubscribeMobile,
                'error' => $e->getMessage()
            ]);
            $this->unsubscribeError = 'Connection error. Please check your internet and try again.';
        }
    }

    public function render()
    {
        return view('livewire.quiz.quiz-profile')
            ->layout('layouts.quiz');
    }
}
