<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class FormGroup extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'form_groups';
    protected $primaryKey = 'id';
    protected $fillable = [
        'form_id',
        'element_id',
        'formula_id',
        'title',
        'sequence',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class, 'form_id');
    }

    public function element()
    {
        return $this->belongsTo(Element::class, 'element_id');
    }

    public function formula()
    {
        return $this->belongsTo(Formula::class, 'formula_id');
    }
}
