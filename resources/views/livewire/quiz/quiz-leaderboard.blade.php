<div class="min-h-screen bg-gradient-to-br from-purple-900 via-purple-800 to-indigo-900 relative overflow-hidden">
    <!-- Background decorative elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <!-- Light blue circles -->
        <div class="absolute top-20 left-10 w-8 h-8 bg-blue-300 rounded-full opacity-20"></div>
        <div class="absolute top-40 right-16 w-6 h-6 bg-blue-200 rounded-full opacity-25"></div>
        <div class="absolute bottom-32 left-20 w-10 h-10 bg-blue-400 rounded-full opacity-15"></div>
        <div class="absolute top-60 left-1/4 w-7 h-7 bg-blue-300 rounded-full opacity-20"></div>
        <div class="absolute bottom-60 right-1/4 w-5 h-5 bg-blue-200 rounded-full opacity-25"></div>
        
        <!-- Orange/yellow dots -->
        <div class="absolute top-24 left-1/2 w-2 h-2 bg-orange-400 rounded-full opacity-30"></div>
        <div class="absolute bottom-32 right-1/3 w-3 h-3 bg-yellow-400 rounded-full opacity-25"></div>
        <div class="absolute top-1/2 left-12 w-2 h-2 bg-orange-300 rounded-full opacity-35"></div>
        <div class="absolute top-1/4 right-1/2 w-2 h-2 bg-yellow-500 rounded-full opacity-20"></div>
        <div class="absolute bottom-1/4 left-1/2 w-3 h-3 bg-orange-400 rounded-full opacity-25"></div>
        
        <!-- Purple zig-zag lines -->
        <div class="absolute top-16 right-24 w-16 h-2 bg-purple-400 transform rotate-45 opacity-20"></div>
        <div class="absolute bottom-40 left-16 w-12 h-2 bg-purple-300 transform -rotate-30 opacity-25"></div>
        <div class="absolute top-1/2 right-8 w-14 h-2 bg-purple-500 transform rotate-15 opacity-15"></div>
        <div class="absolute bottom-1/3 left-1/4 w-10 h-2 bg-purple-400 transform -rotate-60 opacity-30"></div>
    </div>

    <!-- Header -->
    <div class="relative z-10 px-4 pt-8 pb-2">
        <!-- Back Button -->
        <!-- <div class="flex items-center mb-4">
            <a href="/" class="flex items-center text-white/80 hover:text-white transition-colors">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span class="text-sm font-medium">Back</span>
            </a>
        </div> -->
        
        <!-- Title and Tabs -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-white mb-4">Leaderboard</h1>
            
            <!-- Weekly/All Time Toggle -->
            <!-- <div class="flex bg-white/10 backdrop-blur-sm rounded-xl p-1 mx-auto w-fit border border-white/20">
                <button wire:click="filterBy('week')" 
                        class="px-6 py-3 rounded-lg text-sm font-medium transition-all duration-200
                               {{ $filterBy === 'week' ? 'bg-purple-500 text-white' : 'text-white/70 hover:text-white' }}">
                    Weekly
                </button>
                <button wire:click="filterBy('all')" 
                        class="px-6 py-3 rounded-lg text-sm font-medium transition-all duration-200
                               {{ $filterBy === 'all' ? 'bg-purple-500 text-white' : 'text-white/70 hover:text-white' }}">
                    All Time
                </button>
            </div> -->
            
            <!-- Timer (if weekly) -->
            @if($filterBy === 'week')
                <!-- <div class="flex items-center justify-end mt-4">
                    <div class="bg-gray-800 rounded-lg px-3 py-1">
                        <span class="text-white text-sm">06d 23h 00m</span>
                    </div>
                </div> -->
            @endif
        </div>
    </div>

    <!-- User's Rank Card -->
    @if(session('quiz_user') && $userRank)
        <!-- <div class="relative z-10 px-4 mb-6">
            <div class="bg-gradient-to-r from-orange-400 to-orange-500 rounded-2xl p-6 mx-auto max-w-sm">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-orange-600 rounded-full flex items-center justify-center text-white font-bold text-2xl mr-4">
                        #{{ $userRank }}
                    </div>
                    <div class="text-white">
                        <div class="text-lg">You are doing better than</div>
                        <div class="text-2xl font-bold">{{ $userPercentile }}% of other players!</div>
                    </div>
                </div>
            </div>
        </div> -->
    @endif

    <!-- Top 3 Podium -->
    @if($leaderboard->count() >= 3)
        <div class="relative z-10 px-4 mb-6">
            <div class="pt-8">
                <div class="flex items-end justify-center w-full">
                    <!-- 2nd Place (Left) -->
                    @if(isset($leaderboard[1]))
                        <div class="flex flex-col items-center flex-1">
                            <div class="text-center text-white mb-3">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-500 rounded-full flex items-center justify-center text-white font-bold text-xl mx-auto mb-2 relative">
                                    {{ substr($leaderboard[1]->name, 0, 1) }}
                                    <!-- Crown for 2nd place -->
                                    <!-- <svg class="w-6 h-6 text-gray-300 absolute -top-2 left-1/2 transform -translate-x-1/2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg> -->
                                </div>
                                <div class="font-semibold text-md">{{ $leaderboard[1]->name }}</div>
                                <div class="font-semibold text-xs">{{ $leaderboard[1]->city }}</div>
                                <div class="bg-purple-600 rounded-full w-1/2 mx-auto px-1 py-0.5 text-xs text-white mt-1">
                                    {{ number_format($leaderboard[1]->best_percentage, 0) }}%
                                </div>
                                <!-- Flag placeholder -->
                                <!-- <div class="w-6 h-4 bg-gradient-to-r from-red-500 to-yellow-500 rounded-sm mt-2"></div> -->
                            </div>
                            <div class="w-full h-40 flex flex-col items-end">
                                <div class="w-full h-8 bg-white/40" 
                                    style="clip-path: polygon(30% 0%, 100% 0%, 100% 100%, 0% 100%)">
                                </div>
                                <div class="w-full bg-gradient-to-t from-gray-400 to-gray-300 h-36 text-center flex items-end justify-center">
                                    <div class="text-6xl font-bold text-white mb-2">2</div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- 1st Place (Center) -->
                    @if(isset($leaderboard[0]))
                        <div class="flex flex-col items-center flex-1">
                            <div class="text-center text-white mb-3">
                                <div class="w-20 h-20 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-2xl mx-auto mb-2 relative">
                                    {{ substr($leaderboard[0]->name, 0, 1) }}
                                    <!-- Crown for 1st place -->
                                    <!-- <svg class="w-8 h-8 text-yellow-400 absolute -top-3 left-1/2 transform -translate-x-1/2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg> -->
                                </div>
                                <div class="font-bold text-xl">{{ $leaderboard[0]->name }}</div>
                                <div class="font-semibold text-xs">{{ $leaderboard[0]->city }}</div>
                                <div class="bg-purple-600 rounded-full px-3 py-1 text-sm text-white mt-1">
                                    {{ number_format($leaderboard[0]->best_percentage, 0) }}%
                                </div>
                                <!-- Flag placeholder -->
                                <!-- <div class="w-6 h-4 bg-gradient-to-r from-red-500 to-yellow-500 rounded-sm mt-2"></div> -->
                            </div>
                            <div class="w-full h-48 flex flex-col items-end">
                                <div class="w-full h-8 bg-white/60" 
                                    style="clip-path: polygon(10% 0%, 90% 0%, 100% 100%, 0% 100%)">
                                </div>
                                <div class="w-full bg-gradient-to-t from-yellow-400 to-yellow-300 h-44 text-center flex items-end justify-center">
                                    <div class="text-7xl font-bold text-white mb-2">1</div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- 3rd Place (Right) -->
                    @if(isset($leaderboard[2]))
                        <div class="flex flex-col items-center flex-1">
                            <div class="text-center text-white mb-3">
                                <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-500 rounded-full flex items-center justify-center text-white font-bold text-xl mx-auto mb-2 relative">
                                    {{ substr($leaderboard[2]->name, 0, 1) }}
                                    <!-- Crown for 3rd place -->
                                    <!-- <svg class="w-6 h-6 text-orange-400 absolute -top-2 left-1/2 transform -translate-x-1/2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg> -->
                                </div>
                                <div class="font-semibold text-md">{{ $leaderboard[2]->name }}</div>
                                <div class="font-semibold text-xs">{{ $leaderboard[2]->city }}</div>
                                <div class="bg-purple-600 rounded-full w-1/2 mx-auto px-1 py-0.5 text-xs text-white mt-1">
                                    {{ number_format($leaderboard[2]->best_percentage, 0) }}%
                                </div>
                                <!-- Flag placeholder -->
                                <!-- <div class="w-6 h-4 bg-gradient-to-r from-red-500 to-yellow-500 rounded-sm mt-2"></div> -->
                            </div>
                            <div class="w-full h-36 flex flex-col items-end">
                            <div class="w-full h-8 bg-white/40" 
                                    style="clip-path: polygon(0% 0%, 70% 0%, 100% 100%, 0% 100%)">
                                </div>    
                                <div class="w-full bg-gradient-to-t from-orange-400 to-orange-300 h-32 text-center flex items-end justify-center">
                                    <div class="text-6xl font-bold text-white mb-2">3</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    

    <!-- Leaderboard List -->
    <div class="relative z-10 px-4 pb-20">
        <div class="bg-white/10 backdrop-blur-lg rounded-3xl border border-white/20 overflow-hidden">
            @forelse($rest as $index => $participant)
                <div class="flex items-center p-4 border-b border-white/10 last:border-b-0">
                    <!-- Rank -->
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center text-white font-bold text-sm mr-4">
                        {{ $index + 4 }}
                    </div>
                    
                    <!-- Avatar -->
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-500 rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                        {{ substr($participant->name, 0, 1) }}
                    </div>
                    
                    <!-- Name and Score -->
                    <div class="flex-1">
                        <div class="text-white font-semibold text-lg">{{ $participant->name }}</div>
                        <div class="text-white/70 text-sm">{{ $participant->city }}</div>
                    </div>
                    
                    <!-- Score -->
                    <div class="text-right">
                        <div class="text-white font-bold text-lg">{{ number_format($participant->best_percentage, 0) }}%</div>
                        <div class="text-white/60 text-sm">{{ $participant->total_attempts }} attempts</div>
                    </div>
                    
                    <!-- Flag placeholder -->
                    <div class="w-6 h-4 bg-gradient-to-r from-red-500 to-yellow-500 rounded-sm ml-2"></div>
                </div>
            @empty
                @if($leaderboard->count() < 3)
                    <div class="p-8 text-center text-white/60">
                        <div class="text-lg font-medium mb-2">No participants yet</div>
                        <div class="text-sm">Be the first to take the quiz!</div>
                    </div>
                @endif
            @endforelse
        </div>
    </div>

    <!-- Include shared modals -->
    <x-quiz-modals />
</div>