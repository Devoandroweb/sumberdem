<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPages extends Model
{
    use HasFactory;
    use CreatedUpdatedBy;
    protected $table = 'm_pages';
    protected $primaryKey = 'id_pages';
    protected $fillable = ['title', 'cover_image', 'deskripsi', 'maps', 'image', 'vidio', 'url','slug', 'tipe'];
    function menu()
    {
        return $this->hasOne(MMenu::class, 'id_pages');
    }
    function galery()
    {
        return $this->hasMany(MGalery::class, 'id_pages');
    }
}
