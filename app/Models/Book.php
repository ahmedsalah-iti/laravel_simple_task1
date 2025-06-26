<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'description','author_id'];
    public function author()
    {
        return $this->beglongsTo(Author::class);
    }
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function detail(){
        return $this->hasOne(BookDetail::class);
    }
}
