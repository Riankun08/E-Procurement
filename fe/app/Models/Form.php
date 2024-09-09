<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'forms';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category_id',
        'title',
        'type',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
