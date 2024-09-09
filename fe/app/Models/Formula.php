<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'formulas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'matrix',
        'category_id',
        'value',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
