<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingDesign extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'groom_short',
        'bride_short',
        'theme',
        'bg_music_title',
        'bg_music_url',
        'canvas_elements',
        'canvas_config',
    ];

    protected $casts = [
        'canvas_elements' => 'array',
        'canvas_config'   => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}