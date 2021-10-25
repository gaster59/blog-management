<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostMeta extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'post_meta';

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
