<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolvement extends Model
{
    use HasFactory;

    protected $table="resolvement";
    protected $fillable=[
        "ticket_id",
        "resolver_id",
        "spent_time",
        "resolvement_type",
        "description",
        "created_at",
        "updated_at",
    ];
}
