<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class AnswerQuestation extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'answer_questations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'identity_answer_id',
        'form_questions_id',
        'answer',
        'textarea',
        'document',
        'image',
    ];

    public function formQuestion()
    {
        return $this->belongsTo(FormQuestions::class, 'form_questions_id');
    }

    public function identityAnswer()
    {
        return $this->belongsTo(IdentityAnswer::class, 'identity_answer_id');
    }
}
