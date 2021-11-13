<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoLog extends Model
{
    use HasFactory;

    public $table = 'video_logs';

    public $fillable = [
        'message',
        'room_id',
        'agent',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'message' => 'string',
    ];
}
