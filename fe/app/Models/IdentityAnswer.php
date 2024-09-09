<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class IdentityAnswer extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'identity_answers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'form_id',
        'building_name',
        'regulation',
        'consultant',
        'post_date',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class, 'form_id');
    }
}
