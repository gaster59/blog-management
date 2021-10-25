<?php

namespace App\Models;

use App\Models\Category;
use App\Models\PostComment;
use App\Models\PostMeta;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'Post';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'avatar',
        'content',
        'author_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function postComment()
    {
        return $this->hasMany(PostComment::class, 'post_id');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
    }

    public function postMeta()
    {
        return $this->hasMany(PostComment::class, 'post_id');
    }
}
