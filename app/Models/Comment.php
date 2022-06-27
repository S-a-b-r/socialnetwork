<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
