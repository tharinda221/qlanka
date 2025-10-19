<div>
    <div class="max-w-4xl mx-auto">
        @if($isEditing)
            <flux:heading>Edit Question</flux:heading>
            <flux:subheading>Update your quiz question and answers</flux:subheading>
        @else
            <flux:heading>Add New Question</flux:heading>
            <flux:subheading>Create a new quiz question with 4 answer options</flux:subheading>
        @endif

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

        <form wire:submit="save" class="space-y-6">
            <!-- Question Field -->
            <flux:field>
                <flux:label>Question</flux:label>
                <flux:textarea 
                    wire:model="question" 
                    placeholder="Enter your question here..."
                    rows="3"
                />
                <flux:error name="question" />
            </flux:field>


            <!-- Answers Section -->
            <div class="space-y-4">
                <flux:heading size="lg">Answer Options</flux:heading>
                <flux:subheading>Provide 4 answer options and select the correct one</flux:subheading>

                @error('answers')
                    <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800">{{ $message }}</p>
                            </div>
                        </div>
                    </div>
                @enderror

                @foreach($answers as $index => $answer)
                    <div class="flex items-start gap-4 p-4 border border-gray-200 rounded-lg">
                        <div class="flex-1">
                            <flux:field>
                                <flux:label>Answer {{ $index + 1 }}</flux:label>
                                <flux:input 
                                    wire:model="answers.{{ $index }}.text" 
                                    placeholder="Enter answer option {{ $index + 1 }}..."
                                />
                                @error('answers.' . $index . '.text')
                                    <flux:error>{{ $message }}</flux:error>
                                @enderror
                            </flux:field>
                        </div>
                        
                        <div class="flex items-center">
                            <flux:checkbox 
                                wire:click="setCorrectAnswer({{ $index }})"
                                :checked="$answer['is_correct']"
                            />
                            <flux:label class="ml-2">Correct</flux:label>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end gap-4">
                <flux:button type="button" variant="ghost" :href="route('quiz.questions')" wire:navigate>
                    Cancel
                </flux:button>
                <flux:button type="submit">
                    @if($isEditing)
                        Update Question
                    @else
                        Create Question
                    @endif
                </flux:button>
            </div>
        </form>
    </div>
</div>
