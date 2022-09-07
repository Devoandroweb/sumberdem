<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MGalery extends Model
{
    use HasFactory;
    protected $table = 'm_galery';
    protected $primaryKey = 'id_galery';
    public $timestamps = false;
    protected $fillable = ['tipe', 'id_pages', 'nama_file'];
    function pages()
    {
        return $this->belongsTo(MGalery::class, 'id_pages');
    }

}
