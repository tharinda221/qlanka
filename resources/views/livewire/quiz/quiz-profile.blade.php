<div class="min-h-screen bg-gradient-to-br from-purple-800 via-blue-700 to-pink-600 relative overflow-hidden">
    <!-- Background SVG -->
    <div class="absolute inset-0 opacity-20">
        <svg class="w-full h-full" viewBox="0 0 400 800" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
            <!-- Mobile optimized decorative elements -->
            <circle cx="50" cy="50" r="25" fill="white" opacity="0.2"/>
            <circle cx="150" cy="80" r="20" fill="white" opacity="0.25"/>
            <circle cx="250" cy="30" r="30" fill="white" opacity="0.15"/>
            <circle cx="350" cy="60" r="28" fill="white" opacity="0.2"/>
            <circle cx="100" cy="120" r="25" fill="white" opacity="0.18"/>
            <circle cx="200" cy="150" r="30" fill="white" opacity="0.22"/>
            <circle cx="300" cy="100" r="28" fill="white" opacity="0.2"/>
            <circle cx="50" cy="180" r="20" fill="white" opacity="0.25"/>
            <circle cx="150" cy="200" r="25" fill="white" opacity="0.18"/>
            <circle cx="250" cy="170" r="30" fill="white" opacity="0.2"/>
            <circle cx="350" cy="190" r="35" fill="white" opacity="0.15"/>
        </svg>
    </div>

    <!-- Profile Content -->
    <div class="relative z-10 px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <!-- <div class="w-20 h-20 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div> -->
            <h1 class="text-3xl font-bold text-white mb-2">{{ $userData['name'] }}</h1>
            <p class="text-white/80 text-lg">{{ $userData['mobile'] }}</p>
            <p class="text-white/60 text-sm">{{ $userData['city'] }}</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 gap-4 mb-8">
            <!-- Best Score -->
            <div class="bg-black/20 backdrop-blur-lg rounded-xl p-4 border border-white/10">
                <div class="text-center">
                    <div class="text-2xl font-bold text-white">{{ $bestScore }}</div>
                    <div class="text-white/70 text-sm">Best Score</div>
                </div>
            </div>

            <!-- Total Attempts -->
            <div class="bg-black/20 backdrop-blur-lg rounded-xl p-4 border border-white/10">
                <div class="text-center">
                    <div class="text-2xl font-bold text-white">{{ $totalAttempts }}</div>
                    <div class="text-white/70 text-sm">Attempts</div>
                </div>
            </div>

            <!-- Average Score -->
            <div class="bg-black/20 backdrop-blur-lg rounded-xl p-4 border border-white/10">
                <div class="text-center">
                    <div class="text-2xl font-bold text-white">{{ $averageScore }}</div>
                    <div class="text-white/70 text-sm">Avg Score</div>
                </div>
            </div>

            <!-- Time Spent -->
            <div class="bg-black/20 backdrop-blur-lg rounded-xl p-4 border border-white/10">
                <div class="text-center">
                    <div class="text-2xl font-bold text-white">{{ $totalTimeSpent }}m</div>
                    <div class="text-white/70 text-sm">Time Spent</div>
                </div>
            </div>
        </div>

        <!-- Recent Attempts -->
        <div class="bg-black/20 backdrop-blur-lg rounded-xl p-6 border border-white/10 mb-8">
            <h2 class="text-xl font-bold text-white mb-4 text-center">Recent Attempts</h2>
            
            @if($recentAttempts->count() > 0)
                <div class="space-y-3">
                    @foreach($recentAttempts as $attempt)
                        <div class="bg-black/10 rounded-lg p-4 border border-white/5">
                            <div class="flex justify-between items-center">
                                <div>
                                    <div class="text-white font-medium">
                                        Score: {{ $attempt->score }}/{{ $attempt->total_questions }}
                                    </div>
                                    <div class="text-white/60 text-sm">
                                        {{ $attempt->created_at->format('M d, Y H:i') }}
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-white/80 text-sm">
                                        {{ $attempt->time_taken }}s
                                    </div>
                                    <div class="text-xs text-white/60">
                                        {{ $attempt->completed_at ? 'Completed' : 'Incomplete' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="text-white/60 mb-4">No quiz attempts yet</div>
                    <a href="/quiz/play" class="inline-block bg-gradient-to-r from-purple-500 to-pink-500 text-white px-6 py-2 rounded-lg hover:from-purple-600 hover:to-pink-600 transition-all duration-200">
                        Start Your First Quiz
                    </a>
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="space-y-4 pb-20">
            <a href="/quiz/play" 
               class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold py-3 px-4 rounded-lg hover:from-purple-600 hover:to-pink-600 transform hover:scale-105 transition-all duration-200 shadow-lg text-base text-center block">
                Start New Quiz
            </a>
            
            <a href="/quiz/leaderboard" 
               class="w-full bg-black/20 backdrop-blur-lg text-white font-semibold py-3 px-4 rounded-lg hover:bg-black/30 transition-all duration-200 border border-white/20 text-center block">
                View Leaderboard
            </a>
            
            <button wire:click="clearSession" 
                    class="w-full bg-red-500/20 backdrop-blur-lg text-red-300 font-semibold py-3 px-4 rounded-lg hover:bg-red-500/30 transition-all duration-200 border border-red-500/30 text-center">
                Logout
            </button>
        </div>
    </div>
</div>
