<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MKritikSaran extends Model
{
    use HasFactory;
    protected $table = 'm_kritik_saran';
    protected $primaryKey = 'id_kritik_saran';
    public $timestamps = false;
    protected $fillable = ['nama_pengunjung', 'no_telp', 'email', 'deskripsi'];

}
