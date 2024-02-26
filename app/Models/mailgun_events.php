<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mailgun_events extends Model
{
    use HasFactory;

     protected $table = 'mailgun_events';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_type', 'user_id', 'uuid', 'recipient_domain', 'recipient_user', 'msg_to', 'msg_from', 'msg_subject', 'msg_id', 'msg_code','attempt_number','attachments', 'created_at', 'updated_at'
    ];
}
