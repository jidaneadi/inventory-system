<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsetMasuk extends Model
{
    use HasFactory;

    protected $table = "aset_masuk";
    protected $primaryKey = "id_aset_masuk";
    public $incrementing = false;

    protected $fillable = ["id_aset_masuk", "tanggal_masuk", "jumlah", "id_pic", "id_divisi", "id_ruang"];
    protected $guarded = ["created_at", "updated_at"];
}
