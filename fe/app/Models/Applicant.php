<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'applicants';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'company_name',
        'address',
        'gender',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
