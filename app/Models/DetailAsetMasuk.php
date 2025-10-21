<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAsetMasuk extends Model
{
    use HasFactory;


    protected $table = "detail_aset_masuk";
    protected $primaryKey = "id_detail_aset_masuk";

    protected $fillable = ["id_aset_masuk", "id_detail_aset"];
    protected $guarded = ["id_detail_aset_masuk", "created_at", "updated_at"];
}
