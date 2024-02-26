<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'creator_id','name',
        'surname',
        'email',
        'password',
        'is_admin',
        'is_verified',
        'practice_number',
        'phone_number',
        'whatsapp_number',
        'email_message',
        'company',
        'type',
        'image',
        'image_signature',
        'image_logo',
        'region',
        'sub_region',
        ];

    public function getTitleLinkAttribute()
    {
        $title = __('app.show_detail_title', [
            'title' => $this->title, 'type' => __('users.users'),
        ]);
        $link = '<a href="'.route('users.show', $this).'"';
        $link .= ' title="'.$title.'">';
        $link .= $this->title;
        $link .= '</a>';

        return $link;
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
