<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'Category';

    public function post()
    {
        return $this->belongsToMany(Post::class, 'post_category', 'category_id', 'post_id', );
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function childCategory()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
