<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiAset extends Model
{
    use HasFactory;

    protected $table = "mutasi_aset";
    protected $primaryKey = "id_mutasi_aset";
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ["id_mutasi_aset", "id_aset", "id_pic", "tanggal_mutasi"];
    protected $guarded = ["created_at", "updated_at"];

    public function details()
    {
        return $this->hasMany(DetailMutasiAset::class, 'id_mutasi_aset', 'id_mutasi_aset');
    }

    public function history()
    {
        return $this->hasOne(HistoryAset::class, 'id_mutasi_aset', 'id_mutasi_aset');
    }
}
