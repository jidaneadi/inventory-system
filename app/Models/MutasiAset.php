<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiAset extends Model
{
    use HasFactory;

    protected $table = "mutasi_aset";
    protected $primaryKey = "id_mutasi_aset";

    protected $fillable = ["id_aset", "id_pic", "tanggal_mutasi"];
    protected $guarded = ["id_mutasi_aset", "created_at", "updated_at"];
}
