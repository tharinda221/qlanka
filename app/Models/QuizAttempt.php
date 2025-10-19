<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mobile',
        'city',
        'score',
        'total_questions',
        'correct_answers',
        'time_taken',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function quizAnswers(): HasMany
    {
        return $this->hasMany(QuizAnswer::class);
    }

    public function getPercentageAttribute(): float
    {
        if ($this->total_questions === 0) {
            return 0;
        }
        
        return round(($this->correct_answers / $this->total_questions) * 100, 1);
    }

    public function getFormattedTimeAttribute(): string
    {
        $minutes = floor($this->time_taken / 60);
        $seconds = $this->time_taken % 60;
        
        return sprintf('%02d:%02d', $minutes, $seconds);
    }
}