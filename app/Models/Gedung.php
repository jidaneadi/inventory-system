<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;

    protected $table = "gedung";
    protected $primaryKey = "id_gedung";

    protected $fillable = ["nama_gedung", "alamat"];
    protected $guarded = ["id_gedung", "created_at", "updated_at"];
}
