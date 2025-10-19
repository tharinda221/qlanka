<div class="min-h-screen bg-gray-900 relative overflow-hidden">
    <!-- Background decorative elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <!-- Orange lightning bolts -->
        <div class="absolute top-20 left-10 w-8 h-8 bg-orange-400 transform rotate-45 opacity-30"></div>
        <div class="absolute top-40 right-16 w-6 h-6 bg-orange-300 transform rotate-12 opacity-25"></div>
        <div class="absolute bottom-32 left-20 w-10 h-10 bg-orange-500 transform -rotate-12 opacity-20"></div>
        <div class="absolute top-60 left-1/4 w-7 h-7 bg-orange-400 transform rotate-60 opacity-25"></div>
        <div class="absolute bottom-60 right-1/4 w-5 h-5 bg-orange-300 transform -rotate-45 opacity-30"></div>
        
        <!-- Light blue circles -->
        <div class="absolute top-32 right-8 w-12 h-12 bg-blue-300 rounded-full opacity-25"></div>
        <div class="absolute bottom-20 right-12 w-8 h-8 bg-blue-400 rounded-full opacity-30"></div>
        <div class="absolute top-60 left-8 w-6 h-6 bg-blue-200 rounded-full opacity-35"></div>
        <div class="absolute top-80 right-1/3 w-10 h-10 bg-blue-300 rounded-full opacity-20"></div>
        <div class="absolute bottom-80 left-1/3 w-4 h-4 bg-blue-400 rounded-full opacity-40"></div>
        <div class="absolute top-1/3 right-1/4 w-7 h-7 bg-blue-200 rounded-full opacity-25"></div>
        
        <!-- Purple zig-zag lines -->
        <div class="absolute top-16 right-24 w-16 h-2 bg-purple-400 transform rotate-45 opacity-20"></div>
        <div class="absolute bottom-40 left-16 w-12 h-2 bg-purple-300 transform -rotate-30 opacity-25"></div>
        <div class="absolute top-1/2 right-8 w-14 h-2 bg-purple-500 transform rotate-15 opacity-15"></div>
        <div class="absolute bottom-1/3 left-1/4 w-10 h-2 bg-purple-400 transform -rotate-60 opacity-30"></div>
        
        <!-- Small dots -->
        <div class="absolute top-24 left-1/2 w-2 h-2 bg-pink-400 rounded-full opacity-30"></div>
        <div class="absolute bottom-32 right-1/3 w-3 h-3 bg-pink-300 rounded-full opacity-25"></div>
        <div class="absolute top-1/2 left-12 w-2 h-2 bg-yellow-400 rounded-full opacity-35"></div>
        <div class="absolute top-1/4 right-1/2 w-2 h-2 bg-pink-500 rounded-full opacity-20"></div>
        <div class="absolute bottom-1/4 left-1/2 w-3 h-3 bg-yellow-300 rounded-full opacity-25"></div>
        <div class="absolute top-3/4 left-1/3 w-2 h-2 bg-pink-400 rounded-full opacity-30"></div>
        
        <!-- Additional geometric shapes -->
        <div class="absolute top-40 left-1/2 w-6 h-6 bg-green-400 transform rotate-45 opacity-20"></div>
        <div class="absolute bottom-40 right-1/2 w-8 h-8 bg-green-300 transform -rotate-45 opacity-15"></div>
        <div class="absolute top-1/2 right-1/3 w-4 h-4 bg-cyan-400 transform rotate-30 opacity-25"></div>
        <div class="absolute bottom-1/2 left-1/3 w-5 h-5 bg-cyan-300 transform -rotate-30 opacity-20"></div>
        
        <!-- Star shapes -->
        <div class="absolute top-1/4 left-1/4 w-4 h-4 bg-yellow-300 transform rotate-45 opacity-15"></div>
        <div class="absolute bottom-1/4 right-1/4 w-3 h-3 bg-yellow-400 transform -rotate-45 opacity-20"></div>
        <div class="absolute top-3/4 right-1/3 w-3 h-3 bg-yellow-500 transform rotate-60 opacity-10"></div>
        
        <!-- Triangle shapes -->
        <div class="absolute top-1/3 left-1/5 w-0 h-0 border-l-4 border-r-4 border-b-6 border-l-transparent border-r-transparent border-b-red-400 opacity-25"></div>
        <div class="absolute bottom-1/3 right-1/5 w-0 h-0 border-l-4 border-r-4 border-b-6 border-l-transparent border-r-transparent border-b-red-300 opacity-20"></div>
        
        <!-- Hexagon shapes -->
        <div class="absolute top-2/3 left-2/3 w-6 h-6 bg-indigo-400 transform rotate-30 opacity-15"></div>
        <div class="absolute bottom-2/3 right-2/3 w-4 h-4 bg-indigo-300 transform -rotate-30 opacity-25"></div>
    </div>

    @if (!$quizStarted)
        <!-- Quiz Start Screen -->
        <div class="min-h-screen flex items-center justify-center px-4 py-8 relative z-10">
            <div class="text-center">
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl p-8 mb-8 border border-white/20">
                    <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-white mb-4">Ready to Start?</h1>
                    <p class="text-white/80 mb-6">You have 2 minutes to answer 5 questions. Good luck!</p>
                    
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 mb-6 border border-white/20">
                        <h3 class="font-semibold text-white mb-2">Quiz Details:</h3>
                        <ul class="text-sm text-white/80 space-y-1">
                            <li>• 5 multiple choice questions</li>
                            <li>• 2 minutes total time</li>
                            <li>• Instant feedback after each answer</li>
                            <li>• Your progress will be saved</li>
                        </ul>
                    </div>

                    <button 
                        wire:click="startQuiz"
                        class="bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold py-3 px-8 rounded-xl hover:from-purple-600 hover:to-pink-600 transform hover:scale-105 transition-all duration-200 shadow-lg"
                    >
                        Start Quiz Now
                    </button>
                </div>
            </div>
        </div>
    @elseif (!$quizCompleted)
        <!-- Modern Quiz Interface -->
        <div class="min-h-screen flex flex-col">
            <!-- Header -->
            <div class="bg-gray-800 px-4 py-3">
                <!-- Progress Bar and Timer in One Row -->
                <div class="flex items-center justify-between gap-4">
                    <!-- Progress Bar -->
                    <div class="flex-1 bg-gray-600 rounded-full h-10">
                        <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-10 rounded-full transition-all duration-300 flex items-center justify-center" 
                             style="width: {{ $this->getProgressPercentage() }}%">
                            @if($this->getProgressPercentage() > 0)
                                <span class="text-white text-sm font-semibold">{{ $this->getProgressPercentage() }}%</span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Timer -->
                    <div class="flex-shrink-0">
                        <div class="inline-flex items-center space-x-2 bg-gray-700 px-4 py-2 rounded-full h-10">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-white font-semibold">{{ $this->getFormattedTime() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Quiz Content -->
            <div class="flex-1 flex items-center justify-center px-4 py-8 relative">
                @if (!empty($questions) && isset($questions[$currentQuestionIndex]))
                    @php $currentQuestion = $questions[$currentQuestionIndex]; @endphp
                    
                    <div class="w-full max-w-md relative">
                        <!-- Background Card (Partial View) -->
                        <div class="absolute -top-4 -right-4 w-full h-full bg-gradient-to-br from-purple-400 to-purple-500 rounded-3xl opacity-30 transform rotate-2 z-0"></div>
                        
                        <!-- Main Question Card -->
                        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-3xl p-8 shadow-2xl relative overflow-hidden z-10">
                            
                            <!-- Question Counter -->
                            <div class="text-white/80 text-sm mb-4 text-center">Question {{ $currentQuestionIndex + 1 }}/{{ count($questions) }}</div>
                            
                            <!-- Question Text -->
                            <h2 class="text-white text-xl font-bold mb-8 leading-relaxed text-center">
                                {{ $currentQuestion['question'] }}
                            </h2>

                            <!-- Answer Options -->
                            <div class="space-y-3">
                                @foreach($currentQuestion['answers'] as $answer)
                                    <button 
                                        wire:click="selectAnswer({{ $answer['id'] }})"
                                        @if($showFeedback)
                                            @if($selectedAnswer == $answer['id'])
                                                class="w-full p-4 text-center rounded-2xl transition-all duration-200
                                                    @if($answer['is_correct']) 
                                                        bg-green-500 text-white
                                                    @else 
                                                        bg-red-500 text-white
                                                    @endif"
                                            @elseif($answer['is_correct'])
                                                class="w-full p-4 text-center rounded-2xl bg-green-500 text-white transition-all duration-200"
                                            @else
                                                class="w-full p-4 text-center rounded-2xl bg-purple-400 text-white/70 transition-all duration-200"
                                            @endif
                                        @else
                                            class="w-full p-4 text-center rounded-2xl bg-purple-400 hover:bg-purple-300 text-white transition-all duration-200 {{ $selectedAnswer == $answer['id'] ? 'bg-purple-300' : '' }}"
                                        @endif
                                        @if($showFeedback) disabled @endif
                                    >
                                        <span class="font-medium">{{ $answer['answer'] }}</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        {{-- Feedback Message - Commented out for now, can be restored later --}}
                        {{-- @if($showFeedback)
                            <div class="mt-6 p-4 rounded-2xl 
                                @if($feedbackType == 'correct') bg-green-500/20 border border-green-400 @else bg-red-500/20 border border-red-400 @endif">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        @if($feedbackType == 'correct')
                                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium 
                                            @if($feedbackType == 'correct') text-green-300 @else text-red-300 @endif">
                                            {{ $feedbackMessage }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Next Button -->
                            <div class="text-center mt-6">
                                <button 
                                    wire:click="nextQuestion"
                                    class="bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold py-3 px-8 rounded-xl hover:from-purple-600 hover:to-pink-600 transform hover:scale-105 transition-all duration-200 shadow-lg"
                                >
                                    @if($currentQuestionIndex < count($questions) - 1)
                                        Next Question
                                    @else
                                        Finish Quiz
                                    @endif
                                </button>
                            </div>
                        @endif --}}
                    </div>
                @endif
            </div>
        </div>
    @endif

        <!-- Include shared modals -->
        <x-quiz-modals />

    <!-- Timer Script -->
    <script>
        document.addEventListener('livewire:init', () => {
            let timerInterval;
            
            Livewire.on('startTimer', () => {
                timerInterval = setInterval(() => {
                    Livewire.dispatch('timerTick');
                }, 1000);
            });

            Livewire.on('showFeedback', () => {
                // Auto-advance after 1 second
                setTimeout(() => {
                    if (Livewire.find(document.querySelector('[wire\\:id]').getAttribute('wire:id')).currentQuestionIndex < Livewire.find(document.querySelector('[wire\\:id]').getAttribute('wire:id')).questions.length - 1) {
                        Livewire.find(document.querySelector('[wire\\:id]').getAttribute('wire:id')).nextQuestion();
                    } else {
                        Livewire.find(document.querySelector('[wire\\:id]').getAttribute('wire:id')).completeQuiz();
                    }
                }, 800);
            });
        });

    </script>
    </div>
    </div>