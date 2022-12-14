<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketModel extends Model
{
    use HasFactory;

    protected $table="ticket";
    protected $fillable=[
        "creator_id",
        "title",
        "content",
        "status",
        "parent_id",
        "created_at",
        "updated_at",
    ];
}
