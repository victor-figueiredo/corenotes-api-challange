<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notes extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'content',
        'color',
        'isFavorite',
        'user_id'
    ];

    public function user() : BelongsTo{
        return $this->belongsTo(User::class);
    }
}
