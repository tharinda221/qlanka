<?php

namespace App\Livewire\Quiz;

use App\Models\Question;
use Livewire\Component;
use Livewire\WithPagination;

class QuestionList extends Component
{
    use WithPagination;

    public function deleteQuestion($questionId)
    {
        $question = Question::findOrFail($questionId);
        $question->delete();
        
        session()->flash('message', 'Question deleted successfully!');
    }


    public function render()
    {
        $questions = Question::with('answers')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.quiz.question-list', [
            'questions' => $questions
        ]);
    }
}
