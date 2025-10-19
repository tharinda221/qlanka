<div>
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <flux:heading>Quiz Questions</flux:heading>
                <flux:subheading>Manage your quiz questions and answers</flux:subheading>
            </div>
            <flux:button :href="route('quiz.questions.create')" wire:navigate>
                Add New Question
            </flux:button>
        </div>

        @if (session()->has('message'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if($questions->count() > 0)
            <div class="space-y-6">
                @foreach($questions as $question)
                    <div class="bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-lg p-6 shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <flux:heading size="lg">{{ $question->question }}</flux:heading>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-sm text-gray-500">
                                    {{ $question->created_at->format('M d, Y') }}
                                </span>
                                <flux:button 
                                    size="sm" 
                                    variant="primary"
                                    :href="route('quiz.questions.edit', $question->id)" 
                                    wire:navigate
                                >
                                    Edit
                                </flux:button>
                                <flux:button 
                                    size="sm" 
                                    variant="danger"
                                    wire:click="deleteQuestion({{ $question->id }})"
                                    wire:confirm="Are you sure you want to delete this question?"
                                >
                                    Delete
                                </flux:button>
                            </div>
                        </div>

                        <!-- Answers -->
                        <div class="grid grid-cols-2 gap-3 mb-4" style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                            @foreach($question->answers as $answer)
                                <div class="flex items-center gap-3 p-3 rounded-lg {{ $answer->is_correct ? 'bg-green-50 border border-green-300' : 'bg-gray-50/50 border border-gray-100' }}">
                                    <div class="flex-shrink-0">
                                        @if($answer->is_correct)
                                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm0-2a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <span class="{{ $answer->is_correct ? 'text-green-800 font-medium' : 'text-gray-700' }}">
                                            {{ $answer->answer }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $questions->links() }}
            </div>
        @else
            <div class="bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-lg shadow-sm p-6">
                <div class="text-center py-8">
                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                    <flux:heading size="lg" class="mb-2">No Questions Yet</flux:heading>
                    <flux:subheading class="mb-6">Get started by creating your first quiz question</flux:subheading>
                    <flux:button :href="route('quiz.questions.create')" wire:navigate>
                        Create First Question
                    </flux:button>
                </div>
            </div>
        @endif
    </div>
</div>
