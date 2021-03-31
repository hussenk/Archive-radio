<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterLog extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id',
        'description',
        'file_id',
        'action',
    ];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class)->withTimestamps();
    }
}
