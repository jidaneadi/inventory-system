<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsetMasuk extends Model
{
    use HasFactory;

    protected $table = "aset_masuk";
    protected $primaryKey = "id_aset_masuk";

    protected $fillable = ["tanggal_masuk", "jumlah", "id_pic", "id_divisi", "id_ruang"];
    protected $guarded = ["id_aset_masuk", "created_at", "updated_at"];
}
