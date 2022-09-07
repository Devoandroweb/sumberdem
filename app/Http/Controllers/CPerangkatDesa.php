<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPerangkatDesa;
use App\Models\MPerangkatDesa;
use App\Traits\Uploader;
use Illuminate\Http\Request;

class CPerangkatDesa extends Controller
{
    use Uploader;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Perangkat Desa";
        $subTitle = "Kelola " . $title;
        return view('admin.pages.perangkat_desa.index', compact('title', 'subTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah Perangkat Desa";
        $url = route('admin.perangkat_desa.store');
        $data = null;
        $method = null;
        return view('admin.pages.perangkat_desa.form', compact('title', 'url', 'data', 'method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestPerangkatDesa $request)
    {
        $data = $request->validated();
        if($request->hasFile('foto')){
            $data['foto'] = $this->uploadImage(public_path('image/perangkat-desa'),$request->foto);
        }
        MPerangkatDesa::create($data);
        return redirect(route('admin.perangkat_desa.index'))->with('msg', 'Sukses Menambahkan Perangkat Desa');
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

        $title = "Edit Perangkat Desa";
        $url = route('admin.perangkat_desa.update', $id);
        $data = MPerangkatDesa::find(decrypt($id));
        $method = method_field('PUT');
        return view('admin.pages.perangkat_desa.form', compact('title', 'url', 'data', 'method'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestPerangkatDesa $request, $id)
    {
        $data = $request->validated();
        if ($request->hasFile('foto')) {
            $data['foto'] = $this->uploadImage(public_path('image/perangkat-desa'), $request->foto);
        }
        MPerangkatDesa::find(decrypt($id))->update($data);
        return redirect(route('admin.perangkat_desa.index'))->with('msg', 'Sukses Mengubah Perangkat Desa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd(decrypt($id));
        try {
            //code...
            MPerangkatDesa::find(decrypt($id))->delete();
            return response()->json(['status' => true, 'msg' => 'Sukses Menghapus Perangkat Desa']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
            //throw $th;
        }
    }
}
