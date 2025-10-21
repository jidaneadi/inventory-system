<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PIC extends Model
{
    use HasFactory;

    protected $table = "pic";
    protected $primaryKey = "id_pic";

    protected $fillable = ["nama_pic"];
    protected $guarded = ["id_pic", "created_at", "updated_at"];
}
