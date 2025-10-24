<?php

namespace App\Livewire\Quiz;

use Livewire\Component;
use App\Models\QuizAttempt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class QuizHome extends Component
{
    public $mobileNumber = '';
    public $name = '';
    public $city = '';
    public $showMobileModal = false;
    public $showRegistrationModal = false;
    public $showOtpModal = false;
    public $otpCode = '';
    public $existingUser = null;
    public $referenceNo = '';
    public $errorMessage = '';

    public function startQuiz()
    {
        // Check if user already has session data
        if (session()->has('quiz_user')) {
            // User already logged in, redirect to quiz
            return $this->redirect(route('quiz.play'));
        }
        
        // No session, show registration form directly
        $this->showRegistrationForm();
    }

    public function showRegistrationForm()
    {
        // Skip mobile number check, show registration form directly
        $this->showRegistrationModal = true;
    }

    public function submitRegistration()
    {
        $this->validate([
            'name' => 'required|string|min:2|max:100',
            'mobileNumber' => [
                'required',
                'string',
                'regex:/^0[0-9]{9}$/',
                'size:10'
            ],
            'city' => 'required|string',
        ], [
            'mobileNumber.regex' => 'Mobile number must start with 0 and be exactly 10 digits',
            'mobileNumber.size' => 'Mobile number must be exactly 10 digits',
        ]);

        // Reset error message
        $this->errorMessage = '';

        try {
            // Call the phone registration API
            $response = Http::timeout(30)->get('https://myapplanka.com/PrashnaOnline/web/registerPhoneNumber', [
                'phone' => $this->mobileNumber
            ]);
            
            // Log the response for debugging
            Log::info('Phone Registration API Response:', [
                'phone' => $this->mobileNumber,
                'status_code' => $response->status(),
                'response_body' => $response->body(),
                'response_json' => $response->json()
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['status'])) {
                    if ($data['status'] === 'SUCCESS') {
                        // OTP sent successfully, store reference number
                        $this->referenceNo = $data['referenceNo'] ?? '';
                        
                        // Store temporary registration data
                        session([
                            'pending_registration' => [
                                'name' => $this->name,
                                'mobile' => $this->mobileNumber,
                                'city' => $this->city,
                            ],
                            'reference_number' => $this->referenceNo
                        ]);

                        // Close registration modal and show OTP modal
                        $this->showRegistrationModal = false;
                        $this->showOtpModal = true;
                        
                    } elseif ($data['status'] === 'REGISTERED') {
                        // User is already registered, proceed directly to quiz
                        session([
                            'quiz_user' => [
                                'name' => $this->name,
                                'mobile' => $this->mobileNumber,
                                'city' => $this->city,
                            ]
                        ]);
                        
                        return $this->redirect(route('quiz.play'));
                        
                    } else {
                        // Unknown status
                        $this->errorMessage = 'Registration failed. Please try again.';
                    }
                } else {
                    $this->errorMessage = 'Invalid response from server. Please try again.';
                }
            } else {
                $this->errorMessage = 'Unable to connect to verification service. Please try again.';
            }
            
        } catch (\Exception $e) {
            $this->errorMessage = 'Connection error. Please check your internet and try again.';
        }
    }

    public function verifyOtp()
    {
        $this->validate([
            'otpCode' => 'required|numeric|digits:6',
        ], [
            'otpCode.required' => 'Please enter the OTP code',
            'otpCode.numeric' => 'OTP must be numeric',
            'otpCode.digits' => 'OTP must be exactly 6 digits',
        ]);

        // Reset error message
        $this->errorMessage = '';
        
        // Get pending registration data and reference number
        $pendingData = session('pending_registration');
        $referenceNo = session('reference_number');
        
        if (!$pendingData || !$referenceNo) {
            $this->errorMessage = 'Session expired. Please register again.';
            $this->showOtpModal = false;
            $this->showRegistrationModal = true;
            return;
        }

        try {
            // Call OTP verification API
            $response = Http::timeout(30)->get('https://myapplanka.com/PrashnaOnline/web/registerOTPNumber', [
                'phone' => $pendingData['mobile'],
                'otp' => $this->otpCode,
                'referenceNo' => $referenceNo
            ]);
            
            // Log the response for debugging
            Log::info('OTP Verification API Response:', [
                'phone' => $pendingData['mobile'],
                'otp' => $this->otpCode,
                'referenceNo' => $referenceNo,
                'status_code' => $response->status(),
                'response_body' => $response->body(),
                'response_json' => $response->json()
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['status']) && $data['status'] === 'SUCCESS') {
                    // OTP verification successful, complete registration
                    session([
                        'quiz_user' => [
                            'name' => $pendingData['name'],
                            'mobile' => $pendingData['mobile'],
                            'city' => $pendingData['city'],
                        ]
                    ]);

                    // Clear temporary data
                    session()->forget(['pending_registration', 'reference_number']);

                    // Redirect to quiz
                    return $this->redirect(route('quiz.play'));
                    
                } else {
                    // OTP verification failed
                    $this->errorMessage = 'Invalid OTP code. Please try again.';
                }
            } else {
                $this->errorMessage = 'Unable to verify OTP. Please try again.';
            }
            
        } catch (\Exception $e) {
            $this->errorMessage = 'Connection error. Please check your internet and try again.';
        }
    }

    public function render()
    {
        return view('livewire.quiz.quiz-home', [
            'sessionData' => session('quiz_user', null)
        ])->layout('layouts.quiz');
    }
}
