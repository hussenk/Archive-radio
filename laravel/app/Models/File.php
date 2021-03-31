<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title',
        'category_id',
        'description',
        'user_date',
        'path_file',
        'category_sub_id',
    ];


    use HasFactory;
    public function preparation()
    {
        return $this->belongsToMany(Preparation::class)->withTimestamps();
    }

    public function presenter()
    {
        return $this->belongsToMany(Presenter::class)->withTimestamps();
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
    public function category()
    {
        return $this->belongsTo(Categoty::class)->withTimestamps();
    }
    public function categorySub()
    {
        return $this->belongsTo(CategotySub::class)->withTimestamps();
    }
}
