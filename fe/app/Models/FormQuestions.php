<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class FormQuestions extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'form_questions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'form_group_id',
        'questions',
        'regulation',
        'statement',
        'sequence',
    ];

    public function formGroup()
    {
        return $this->belongsTo(FormGroup::class, 'form_group_id');
    }
}
