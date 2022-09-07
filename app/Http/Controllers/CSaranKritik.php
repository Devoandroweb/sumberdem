<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestKritikSaran;
use App\Models\MKritikSaran;
use Illuminate\Http\Request;

class CSaranKritik extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Kritik dan Saran";
        $subTitle = "Kelola ". $title;
        return view('admin.pages.kritiksaran.index', compact('title', 'subTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah Kitik/Saran";
        $url = route('admin.kritiksaran.store');
        $data = null;
        $method = null;
        return view('admin.pages.kritiksaran.form', compact('title', 'url', 'data', 'method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestKritikSaran $request)
    {
        $data = $request->validated();
        MKritikSaran::create($data);
        return redirect(route('admin.kritiksaran.index'))->with('msg', 'Sukses Menambahkan Kritik/Saran');
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

        $title = "Edit Kritik/Saran";
        $url = route('admin.kritiksaran.update', $id);
        $data = MKritikSaran::find(decrypt($id));
        $method = method_field('PUT');
        return view('admin.pages.kritiksaran.form', compact('title', 'url', 'data', 'method'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestKritikSaran $request, $id)
    {
        $data = $request->validated();
        MKritikSaran::find(decrypt($id))->update($data);
        return redirect(route('admin.kritiksaran.index'))->with('msg', 'Sukses Mengubah Kritik/Saran');
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
            MKritikSaran::find(decrypt($id))->delete();
            return response()->json(['status'=> true,'msg' => 'Sukses Menghapus Kritik/Saran']);
        } catch (\Throwable $th) {
            return response()->json(['status'=> false,'msg' => $th->getMessage()]);
            //throw $th;
        }
    }
}
