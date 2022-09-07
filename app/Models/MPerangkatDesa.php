<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPerangkatDesa extends Model
{
    use HasFactory;
    protected $table = 'm_perangkat_desa';
    public $timestamps = false;
    protected $fillable = ['foto','nama', 'jabatan', 'facebook', 'instagram', 'email'];
}
