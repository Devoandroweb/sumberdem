<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPages;
use App\Models\MGalery;
use App\Models\MPages;
use App\Traits\Uploader;
use Illuminate\Support\Str;

class CPages extends Controller
{
    use Uploader;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Pages";
        $subTitle = "Kelola Halaman";
        return view('admin.pages.pages.index',compact('title','subTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah Halaman";
        $url = route('admin.pages.store');
        $data = null;
        $method = null;
        $tipes = $this->makeTipes();
        $images = [];
        $vidios = [];

        return view('admin.pages.pages.form',compact('title','url','data','method','tipes','images','vidios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestPages $request)
    {
        $data = $request->validated();
        $slug = Str::slug($data['title']);
        $data['cover_image'] = $this->uploadImage(public_path('image/pages'),$request->cover_image);
        $data['slug'] = $slug;
        $data['maps'] = $request->maps;
        $data['url'] = 'pages/'.$slug;
        $pages = MPages::create($data);
        $this->saveGalery($request, $pages->id_pages);
        return redirect(route('admin.pages.index'))->with('msg','Sukses Menambahkan Halaman');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit Halaman";
        $url = route('admin.pages.update',$id);
        $data = MPages::where('id_pages',decrypt($id))->with('galery')->first();
        $tipes = $this->makeTipes();
        $images = [];
        $vidios = [];
        $idImages = 1;
        $idVidios = 1;
        // dd($data->galery);
        foreach ($data->galery as $galery) {
            if($galery->tipe == 1){
                $images[] = [
                    'id' => $galery->id_galery,
                    'src' => asset('image/pages/galery_foto/'.$galery->nama_file),
                ];
            }
            $idImages++;
        }
        foreach ($data->galery as $galery) {
            if ($galery->tipe == 2) {
                $vidios[] = [
                    'id' => $galery->id_galery,
                    'nama_file' => $galery->nama_file,
                ];
            }
            $idVidios++;
        }
        $method = method_field('PUT');
        return view('admin.pages.pages.form', compact('title', 'url', 'data', 'method', 'tipes','images','vidios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestPages $request, $id)
    {
        // dd($request->all());
        
        $data = $request->validated();
        $slug = Str::slug($data['title']);
        if($request->cover_image != null){
            $data['cover_image'] = $this->uploadImage(public_path('image/pages'), $request->cover_image);
            unlink(public_path('image/pages/'.$request['cover_image-old']));
        }
        $this->saveGalery($request,decrypt($id));
        $data['maps'] = $request->maps;
        $data['slug'] = $slug;
        $data['url'] = 'pages/' . $slug;
        MPages::find(decrypt($id))->update($data);
        return redirect(route('admin.pages.index'))->with('msg', 'Sukses Mengubah Halaman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function makeTipes()
    {
        $tipes[] = ['id_tipe' => 1, 'label' => 'Visi dan Misi'];
        $tipes[] = ['id_tipe' => 2, 'label' => 'Kegiatan Desa'];
        $tipes[] = ['id_tipe' => 3, 'label' => 'Organisasi Desa'];
        $tipes[] = ['id_tipe' => 4, 'label' => 'Kampung Wisata'];
        $tipes[] = ['id_tipe' => 5, 'label' => 'Berita'];
        return $tipes;
    }
    public function saveGalery($request,$id)
    {
        $tipeForGalery = [2, 4];
        // exec galery
        if (in_array($request->tipe, $tipeForGalery)) {
            // foto
            $dataImages = [];
            // dd($request->images);
            if($request->images != null){
                foreach ($request->images as $image) {
                    if (!is_null($image) || !empty($image)) {
                        if (file_exists(public_path('image/pages/galery_foto/' . $image->getClientOriginalName()))) {
                            unlink(public_path('image/pages/galery_foto/'.$image->getClientOriginalName()));
                        }
                        $dataImages[] = [
                            'tipe' => 1,
                            'id_pages' => $id,
                            'nama_file' => $this->uploadImage(public_path('image/pages/galery_foto'), $image)
                        ];
                    }
                }
            }
            // remove images
            if(!is_null($request->imgremove) || !empty($request->imgremove)){
                // get galery
                $imgRemoveArray = explode(",",$request->imgremove);
                $removeGalery = MGalery::whereIn('id_galery',$imgRemoveArray)->get();
                foreach ($removeGalery as $rg) {
                    unlink(public_path('image/pages/galery_foto/' . $rg->nama_file));
                    $rg->delete();
                }
            }
            // vidio
            $dataVidios = [];
            foreach ($request->vidio as $vidio) {
                if (!is_null($vidio) || !empty($vidio)) {
                    $dataVidios[] = [
                        'tipe' => 2,
                        'id_pages' => $id,
                        'nama_file' => $vidio
                    ];
                }
            }
            // remove vidios
            MGalery::where('id_pages', $id)->where('tipe',2)->delete();
            // end galery
            
            MGalery::insert($dataImages);
            MGalery::insert($dataVidios);
        }else{
            $removeGalery = MGalery::where('id_pages', $id)->get();
            foreach ($removeGalery as $rg) {
                unlink(public_path('image/pages/galery_foto/' . $rg->nama_file));
                $rg->delete();
            }
            MGalery::where('id_pages', $id)->delete();
        }
    }
    
}
