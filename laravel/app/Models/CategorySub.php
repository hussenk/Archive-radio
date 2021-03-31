<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategorySub extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title',
        'description',
        'category_id',
    ];

    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class)->withTimestamps();
    }
    public function files()
    {
        return $this->hasMany(File::class)->withTimestamps();
    }
}
