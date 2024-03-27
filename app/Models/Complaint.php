<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'TicketID',
        'subject',
        'booking_id',
        'issues_detail',
        'file',
        'status',
        'user_id',
        'role_id',
        'type'
    ];
    public function Notifier()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
