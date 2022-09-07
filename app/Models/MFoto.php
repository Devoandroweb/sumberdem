<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MFoto extends Model
{
    use HasFactory;
    protected $table = 'm_foto';
    protected $primaryKey = 'id_foto';
    public $timestamps = false;
    protected $fillable = ['title', 'image', 'deskripsi'];

}
