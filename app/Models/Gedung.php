<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;

    protected $table = "gedung";
    protected $primaryKey = "id_gedung";

    protected $fillable = ["id_gedung", "nama_gedung", "alamat"];
    protected $guarded = ["created_at", "updated_at"];
}
