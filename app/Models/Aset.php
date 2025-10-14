<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;

    protected $table = "aset";
    protected $primaryKey = "id_aset";
    protected $fillable = [
        "id_aset",
        "nama_aset",
        "jenis_aset"
    ];

    protected $guarted = ["created_at", "updated_at"];
}
