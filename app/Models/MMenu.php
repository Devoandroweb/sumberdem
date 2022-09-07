<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMenu extends Model
{
    use HasFactory;
    protected $table = 'm_menu';
    protected $primaryKey = 'id_menu';
    public $timestamps = false;
    protected $fillable = ['title', 'label' , 'id_pages', 'parent', 'aktif'];
    function pages()
    {
        return $this->belongsTo(MPages::class, 'id_pages');
    }
}
