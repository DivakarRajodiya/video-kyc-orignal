<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Room
 * @package App\Models
 * @version November 8, 2021, 6:00 am UTC
 *
 * @property string $agent
 * @property string $visitor
 * @property string $agenturl
 * @property string $visitorurl
 * @property string $password
 * @property string $roomId
 * @property string $datetime
 * @property string $duration
 * @property string $shortagenturl
 * @property string $shortvisitorurl
 * @property string $agent_id
 * @property string $is_active
 * @property string $agenturl_broadcast
 * @property string $visitorurl_broadcast
 * @property string $shortagenturl_broadcast
 * @property string $shortvisitorurl_broadcast
 * @property string $title
 */
class Room extends Model
{
    use HasFactory;

    public $table = 'rooms';

    public $fillable = [
        'agent',
        'visitor',
        'agenturl',
        'visitorurl',
        'password',
        'roomId',
        'datetime',
        'duration',
        'shortagenturl',
        'shortvisitorurl',
        'agent_id',
        'is_active',
        'agenturl_broadcast',
        'visitorurl_broadcast',
        'shortagenturl_broadcast',
        'shortvisitorurl_broadcast',
        'title'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'agent' => 'string',
        'visitor' => 'string',
        'agenturl' => 'string',
        'visitorurl' => 'string',
        'password' => 'string',
        'roomId' => 'string',
        'datetime' => 'string',
        'duration' => 'string',
        'shortagenturl' => 'string',
        'shortvisitorurl' => 'string',
        'agent_id' => 'string',
        'agenturl_broadcast' => 'string',
        'visitorurl_broadcast' => 'string',
        'shortagenturl_broadcast' => 'string',
        'shortvisitorurl_broadcast' => 'string',
        'title' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'agent' => 'required',
        'visitor' => 'required',
    ];
}
