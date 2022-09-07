<?php

namespace App\Http\Controllers;

use App\Models\MPages;
use Illuminate\Http\Request;

class CBerita extends Controller
{
    function index()
    {
        $berita = MPages::where('tipe',5)->paginate(9);
        return view('client.list-berita',compact('berita'));
    }
}
