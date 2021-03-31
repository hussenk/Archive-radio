<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'type',
    ];


    use HasFactory;
    public function CategorySubs()
    {
        $this->hasMany(CategorySub::class)->withTimestamps();
    }
    public function files()
    {
        return $this->hasMany(File::class)->withTimestamps();
    }
}
