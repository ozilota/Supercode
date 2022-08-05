<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketDetayModel extends Model
{
    use HasFactory;
    protected $table="ticket_detail";
    protected $fillable=[
        "creator_id",
        "ticket_id",
        "reply",
        "created_at",
        "updated_at",
    ];
}
