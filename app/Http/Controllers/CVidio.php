<?php

namespace App\Http\Controllers;

use App\Models\MVidio;
use Illuminate\Http\Request;

class CVidio extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Kelola Vidio";
        $data = MVidio::all();
        return view('admin.pages.vidio.index',compact('title', 'data'));
    }
    public function update(Request $request)
    {
        MVidio::truncate();
        foreach ($request->vidio as $key) {
            if(!is_null($key) || !empty($key)){
                MVidio::create([
                    'embed' => $key
                ]);
            }
        }
        return redirect(url('admin/vidio'))->with('msg', 'Sukses Simpan List Vidio');

    }
}
