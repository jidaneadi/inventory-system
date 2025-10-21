<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;


    protected $table = "divisi";
    protected $primaryKey = "id_divisi";

    protected $fillable = ["nama_divisi"];
    protected $guarded = ["id_divisi", "created_at", "updated_at"];
}
