<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MVidio extends Model
{
    use HasFactory;
    protected $table = 'm_vidio';
    protected $primaryKey = 'id_vidio';
    public $timestamps = false;
    protected $fillable = ['embed'];
    
}
