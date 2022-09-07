<?php

namespace App\Http\Controllers;

use App\Models\MFoto;
use App\Traits\Uploader;
use Illuminate\Http\Request;

class CFoto extends Controller
{
    use Uploader;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Galery Foto";
        $subTitle = "Kelola Halaman";
        $data = MFoto::all();
        return view('admin.pages.foto.index', compact('title','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah Foto";
        return view('admin.pages.foto.form', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $foto = [];
        foreach($request->images as $img){
            $foto[] = [
                'image' => $this->uploadImage(public_path('image/foto'), $img)
            ];
        }
        MFoto::insert($foto);
        return redirect(route('admin.foto.index'))->with('msg','Sukses Menambahkan Galery Foto');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $foto = MFoto::find($id);
        unlink(public_path('image/foto/'.$foto->image));
        $foto->delete();
        $fotoAll = MFoto::all();
        return response()->json(['status' => true, 'msg' => "Berhasil Mengahapus Foto",'data'=> $fotoAll]);

    }
}
