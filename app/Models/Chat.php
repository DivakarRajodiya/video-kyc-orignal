<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    public $table = 'chats';

    public $fillable = [
        'message',
        'system',
        'participants',
        'from',
        'agent_id',
        'date_created',
        'avatar',
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
        'system' => 'string',
        'participants' => 'string',
        'from' => 'string',
        'agent_id' => 'string',
    ];
}
