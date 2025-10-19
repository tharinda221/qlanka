<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Quiz' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Force light theme only
        document.documentElement.classList.remove('dark');
        document.documentElement.style.colorScheme = 'light';
    </script>
</head>
<body class="min-h-screen">
    {{ $slot }}
    
    <!-- Footer Navigation -->
    <div class="fixed bottom-0 left-0 right-0 bg-gray-800 border-t border-gray-600 shadow-lg z-50">
        <div class="flex justify-around items-center">
            <!-- Leaderboard Button -->
            <a href="/quiz/leaderboard" class="flex flex-col items-center py-3 px-4 text-gray-300 hover:text-purple-400 transition-colors cursor-pointer">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span class="text-xs font-medium">Leaderboard</span>
            </a>
            
            <!-- Home Button (Center) -->
            <a href="/" class="flex flex-col items-center py-3 px-4 text-purple-400 cursor-pointer">
                <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mb-1">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium">Home</span>
            </a>
            
            <!-- My Profile Button -->
            <a href="/quiz/profile" class="flex flex-col items-center py-3 px-4 text-gray-300 hover:text-purple-400 transition-colors cursor-pointer">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span class="text-xs font-medium">My Profile</span>
            </a>
        </div>
    </div>
</body>
</html>
