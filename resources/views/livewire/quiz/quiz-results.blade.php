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

    <div class="min-h-screen flex items-center justify-center px-4 py-8 relative z-10">
        <div class="w-full max-w-2xl relative">
            <!-- Background Card (Partial View) -->
            <div class="absolute -top-4 -right-4 w-full h-full bg-white/10 backdrop-blur-lg rounded-3xl opacity-30 transform rotate-2 z-0 border border-white/20"></div>
            
            <!-- Main Results Card -->
            <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 shadow-2xl relative overflow-hidden z-10 border border-white/20">
                <!-- Title -->
                <h1 class="text-3xl font-bold text-white text-center mb-4">සාමාන්‍ය දැනුම Quiz</h1>
                
                <!-- Time Taken -->
                <div class="text-white/80 text-center mb-4">කාලය: {{ $quizAttempt->formatted_time }}</div>
                
                <!-- Score -->
                <div class="text-4xl font-bold text-white text-center mb-8">{{ $quizAttempt->correct_answers }} / {{ $quizAttempt->total_questions }} ({{ $percentage }}%)</div>
                
                <!-- Congratulations Box -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 mb-8 border border-white/20">
                    <!-- Congratulations Header -->
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-yellow-800" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white">සුබපැතුම්!</h2>
                    </div>
                    
                    <!-- Completion Message -->
                    <p class="text-white/90 text-center mb-4">ඔබ සාර්ථක ලෙස quiz එක සම්පූර්ණ කළා!</p>
                    
                    <!-- Leaderboard Button -->
                    <div class="text-center">
                        <a href="/quiz/leaderboard" 
                           class="inline-block bg-gradient-to-r from-purple-500 to-pink-500 text-white font-bold py-3 px-8 rounded-xl hover:from-purple-600 hover:to-pink-600 transform hover:scale-105 transition-all duration-200 shadow-lg">
                            View Leaderboard
                        </a>
                    </div>
                </div>
                
                <!-- Footer Links -->
                <div class="flex gap-4 justify-center">
                    <button onclick="openTermsModal()" 
                            class="px-6 py-2 border border-white/30 text-white/80 rounded-lg hover:bg-white/10 transition-colors">
                        Terms & Conditions
                    </button>
                    <button onclick="openPrivacyModal()" 
                            class="px-6 py-2 border border-white/30 text-white/80 rounded-lg hover:bg-white/10 transition-colors">
                        Privacy Policy
                    </button>
                </div>
            </div>
        </div>
    </div>

        <!-- Include shared modals -->
        <x-quiz-modals />
    </div>

    <script>
        function clearQuizSession() {
            // Clear any existing quiz session data by redirecting to clear-session route
            window.location.href = '/quiz/clear-session';
        }

        function getDataPackage() {
            alert('Data package feature coming soon!');
        }

        // Ensure modal functions are available
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Modal functions loaded:', {
                openTermsModal: typeof window.openTermsModal,
                openPrivacyModal: typeof window.openPrivacyModal
            });
        });

        // Fallback modal functions
        window.openTermsModal = function() {
            const modal = document.getElementById('termsModal');
            if (modal) {
                modal.style.display = 'flex';
                modal.style.zIndex = '99999';
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        };

        window.closeTermsModal = function() {
            const modal = document.getElementById('termsModal');
            if (modal) {
                modal.style.display = 'none';
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        };

        window.openPrivacyModal = function() {
            const modal = document.getElementById('privacyModal');
            if (modal) {
                modal.style.display = 'flex';
                modal.style.zIndex = '99999';
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        };

        window.closePrivacyModal = function() {
            const modal = document.getElementById('privacyModal');
            if (modal) {
                modal.style.display = 'none';
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        };

    </script>