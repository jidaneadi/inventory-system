<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAset extends Model
{
    use HasFactory;
    protected $table = 'detail_aset';
    protected $primaryKey = 'id_detail_aset';
    public $incrementing = false;

    protected $fillable = [
        "id_detail_aset", "id_aset", "serial_number", "id_bahan", "id_merk", "kondisi"
    ];
    protected $guarded = [ "created_at", "updated_at"];

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'id_aset', 'id_aset');
    }
}
