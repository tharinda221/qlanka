<?php

namespace App\Livewire\Quiz;

use App\Models\Question;
use App\Models\Answer;
use Livewire\Component;
use Livewire\Attributes\Validate;

class QuestionForm extends Component
{
    #[Validate('required|string|min:10')]
    public string $question = '';


    #[Validate('required|array|size:4')]
    public array $answers = [
        ['text' => '', 'is_correct' => false],
        ['text' => '', 'is_correct' => false],
        ['text' => '', 'is_correct' => false],
        ['text' => '', 'is_correct' => false],
    ];

    public $questionId = null;
    public $isEditing = false;

    public function mount($question = null)
    {
        if ($question) {
            // If $question is a string (ID), load the model
            if (is_string($question) || is_numeric($question)) {
                $question = Question::with('answers')->findOrFail($question);
            }
            
            $this->isEditing = true;
            $this->questionId = $question->id;
            $this->question = $question->question;
            
            // Load existing answers
            $existingAnswers = $question->answers;
            $this->answers = [];
            
            for ($i = 0; $i < 4; $i++) {
                if (isset($existingAnswers[$i])) {
                    $this->answers[] = [
                        'text' => $existingAnswers[$i]->answer,
                        'is_correct' => $existingAnswers[$i]->is_correct
                    ];
                } else {
                    $this->answers[] = ['text' => '', 'is_correct' => false];
                }
            }
        } else {
            // Initialize with 4 empty answers for new question
            $this->answers = [
                ['text' => '', 'is_correct' => false],
                ['text' => '', 'is_correct' => false],
                ['text' => '', 'is_correct' => false],
                ['text' => '', 'is_correct' => false],
            ];
        }
    }

    public function setCorrectAnswer($index)
    {
        // Reset all answers to false
        foreach ($this->answers as $key => $answer) {
            $this->answers[$key]['is_correct'] = false;
        }
        
        // Set the selected answer as correct
        $this->answers[$index]['is_correct'] = true;
    }

    public function save()
    {
        $this->validate();

        // Validate that exactly one answer is marked as correct
        $correctCount = collect($this->answers)->where('is_correct', true)->count();
        
        if ($correctCount !== 1) {
            $this->addError('answers', 'Please select exactly one correct answer.');
            return;
        }

        // Validate that all answers have text
        foreach ($this->answers as $index => $answer) {
            if (empty(trim($answer['text']))) {
                $this->addError('answers.' . $index . '.text', 'Answer text is required.');
                return;
            }
        }

        if ($this->isEditing) {
            // Update existing question
            $question = Question::findOrFail($this->questionId);
            $question->update([
                'question' => $this->question,
            ]);

            // Delete existing answers and create new ones
            $question->answers()->delete();
            
            foreach ($this->answers as $index => $answerData) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer' => $answerData['text'],
                    'is_correct' => $answerData['is_correct'],
                ]);
            }

            session()->flash('message', 'Question updated successfully!');
        } else {
            // Create new question
            $question = Question::create([
                'question' => $this->question,
            ]);

            // Create the answers
            foreach ($this->answers as $index => $answerData) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer' => $answerData['text'],
                    'is_correct' => $answerData['is_correct'],
                ]);
            }

            session()->flash('message', 'Question created successfully!');
        }

        // Reset the form
        $this->reset(['question']);
        $this->mount();
        
        // Redirect to question list
        return $this->redirect(route('quiz.questions'));
    }

    public function render()
    {
        return view('livewire.quiz.question-form');
    }
}
