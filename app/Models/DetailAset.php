<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAset extends Model
{
    use HasFactory;
    protected $table = 'detail_aset';
    protected $primaryKey = 'id_detail_aset';

    protected $fillable = [
        "id_aset", "serial_number", "id_bahan", "id_merk", "kondisi"
    ];
    protected $guarded = ["id_detail_aset", "created_at", "updated_at"];

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'id_aset', 'id_aset');
    }
}
