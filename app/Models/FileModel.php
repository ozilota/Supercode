<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileModel extends Model
{
    use HasFactory;

    protected $table="files";
    protected $fillable=[
        "ticket_id",
        "ticket_detail_id",
        "file",
    ];
}
