<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Quiz\QuestionForm;
use App\Livewire\Quiz\QuestionList;
use App\Livewire\Quiz\QuizHome;
use App\Livewire\Quiz\QuizInterface;
use App\Livewire\Quiz\QuizResults;
use App\Livewire\Quiz\QuizLeaderboard;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Quiz Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/

// Home page with registration popup
Route::get('/', QuizHome::class)->name('home');

// Quiz flow routes
Route::post('/quiz/check-mobile', function() {
    $request = request();
    $mobile = $request->input('mobile');
    
    $user = \App\Models\QuizAttempt::where('mobile', $mobile)->first();
    
    if ($user) {
        // User exists, store in session
        session([
            'quiz_user' => [
                'name' => $user->name,
                'mobile' => $user->mobile,
                'city' => $user->city,
            ]
        ]);
        
        return response()->json(['exists' => true]);
    } else {
        return response()->json(['exists' => false]);
    }
})->name('quiz.check-mobile');

Route::post('/quiz/register', function() {
    $component = new QuizInterface();
    return $component->handleRegister();
})->name('quiz.register');

Route::post('/quiz/start', function() {
    $component = new QuizInterface();
    return $component->handleRegistration();
})->name('quiz.start');

Route::get('/quiz/play', QuizInterface::class)->name('quiz.play');
Route::get('/quiz/results/{id}', QuizResults::class)->name('quiz.results');
Route::get('/quiz/leaderboard', QuizLeaderboard::class)->name('quiz.leaderboard');
Route::get('/quiz/profile', \App\Livewire\Quiz\QuizProfile::class)->name('quiz.profile');

// Session management
Route::get('/quiz/clear-session', function() {
    session()->forget('quiz_user');
    return redirect()->route('home');
})->name('quiz.clear-session');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::view('dashboard', 'dashboard')
        ->middleware(['verified'])
        ->name('dashboard');

    // Settings
    Route::redirect('settings', 'settings/profile');
    
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

// Quiz Management (Admin/Teacher routes)
Route::middleware(['auth'])->prefix('quiz')->name('quiz.')->group(function () {
    Route::get('questions', QuestionList::class)->name('questions');
    Route::get('questions/create', QuestionForm::class)->name('questions.create');
    Route::get('questions/{question}/edit', QuestionForm::class)->name('questions.edit');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
