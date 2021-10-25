<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostComment extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'PostComment';

    public function Post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
