<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $guarded = false;

    public function author(){
        return $this->belongsTo(User::class, 'author_id','id');
    }

    public function profile(){
        return $this->belongsTo(User::class, 'profile_id','id');
    }

    public function answerTo(){
        return DB::select('SELECT * FROM `comments` LEFT JOIN `users` ON comments.author_id = users.id WHERE comments.id = ?',[$this->comment_id])[0];
    }
}
