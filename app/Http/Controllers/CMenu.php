<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestMenu;
use App\Models\MMenu;
use App\Models\MPages;
use Illuminate\Http\Request;

class CMenu extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd("asdasd");
        $title = "Menu";
        $subTitle = "Kelola " . $title;
        return view('admin.menu.index', compact('title', 'subTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah Menu";
        $url = route('admin.menu.store');
        $data = null;
        $method = null;
        $pages = MPages::all();
        $menus = MMenu::all();

        return view('admin.menu.form', compact('title', 'url', 'data', 'method', 'pages','menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestMenu $request)
    {
        // dd($request->all());
        $data = $request->validated();
        if(isset($request->aktif)){
            $data['aktif'] = 1;
        }else{
            $data['aktif'] = 0;
        }
        MMenu::create($data);
        return redirect(route('admin.menu.index'))->with('msg', 'Sukses Menambahkan Menu');
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

        $title = "Edit Menu";
        $url = route('admin.menu.update', $id);
        $data = MMenu::find(decrypt($id));
        $pages = MPages::all();
        $menus = MMenu::all();
        $method = method_field('PUT');
        return view('admin.menu.form', compact('title', 'url', 'data', 'method','pages', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestMenu $request, $id)
    {
        $data = $request->validated();
        if (isset($request->aktif)) {
            $data['aktif'] = 1;
        } else {
            $data['aktif'] = 0;
        }
        MMenu::find(decrypt($id))->update($data);
        return redirect(route('admin.menu.index'))->with('msg', 'Sukses Mengubah Menu');
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
            MMenu::find(decrypt($id))->delete();
            return response()->json(['status' => true, 'msg' => 'Sukses Menghapus Menu']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
            //throw $th;
        }
    }
}
