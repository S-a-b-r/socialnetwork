<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = false;
    protected $table = 'books';
    use HasFactory;

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
