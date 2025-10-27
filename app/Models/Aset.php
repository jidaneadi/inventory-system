<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;

    protected $table = "aset";
    protected $primaryKey = "id_aset";
    public $incrementing = false;

    protected $fillable = [
        "id_aset",
        "nama_aset",
        "jenis_aset"
    ];

    protected $guarded = ["created_at", "updated_at"];

    public function detail_aset()
    {
        return $this->hasMany(DetailAset::class, 'id_aset', 'id_aset');
    }
    public function jenis()
{
    return $this->belongsTo(Jenis::class, 'jenis_aset', 'id_jenis');
}

}
