<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;

    protected $table = "ruang";
    protected $primaryKey = "id_ruang";
    public $incrementing = false;

    protected $fillable = ["nama_ruang", "id_gedung"];
    protected $guarded = ["id_ruang", "created_at", "updated_at"];
}
