<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMutasiAset extends Model
{
    use HasFactory;


    protected $table = "detail_mutasi_aset";
    protected $primaryKey = "id_detail_mutasi_aset";

    protected $fillable = ["id_mutasi_aset", "id_detail_aset", "id_divisi"];
    protected $guarded = ["id_detail_mutasi_aset", "created_at", "updated_at"];
}
