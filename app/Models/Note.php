<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = 'note';

    protected $fillable = [
        'id', 'content', 'is_delete', 'important', 'is_complete', 'user_name'
    ];


    // Định nghĩa mối quan hệ ngược từ Note tới User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_name', 'user_name');
    }
}
