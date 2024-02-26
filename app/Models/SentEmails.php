<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use jdavidbakr\MailTracker\Concerns\IsSentEmailModel;
use jdavidbakr\MailTracker\Contracts\SentEmailModel;

class SentEmails extends Model implements SentEmailModel {
    use IsSentEmailModel;

    protected static $unguarded = true;

    protected $casts = [
        'meta' => 'collection',
        'opened_at' => 'datetime',
        'clicked_at' => 'datetime',
    ];
}