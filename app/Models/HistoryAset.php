<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryAset extends Model
{
    use HasFactory;

    protected $table = "history";
    protected $primaryKey = "id_history";

    protected $fillable = ["id_mutasi_aset", "jenis_mutasi", "tanggal_mutasi"];
    protected $guarded = ["id_history", "created_at", "updated_at"];
}
