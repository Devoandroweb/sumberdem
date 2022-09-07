<?php

namespace App\Http\Controllers;

use App\Models\MKritikSaran;
use App\Models\MMenu;
use App\Models\MObat;
use App\Models\MPages;
use App\Models\MPerangkatDesa;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
class CDataTable extends Controller
{
    public function pages()
    {
        $model = MPages::query();
        // dd(Auth::user()->id);
        return DataTables::eloquent($model)

            ->addColumn('cover_image_conv', function ($row) {
                return '<img src="'. asset('image/pages/'.$row->cover_image).'"  
                style="width: 100px;" class="shadow img-fluid" >';
            })
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a href="' . route('admin.pages.edit', encrypt($row->id_pages)) . '" class="text-primary edit" tooltip="Edit Halaman"><i class="fas fa-pencil-alt mr-2"></i></a>';
                $btn .= '<a href="' . route('admin.pages.destroy', encrypt($row->id_pages)) . '" class="text-danger delete mr-2" tooltip="Hapus Halaman"><i class="far fa-trash-alt"></i></a>';
                
                return $btn;
            })
            ->rawColumns(['action', 'cover_image_conv'])
            ->addIndexColumn()
            ->toJson();
    }
    public function kritiksaran()
    {
        $model = MKritikSaran::query();
        // dd(Auth::user()->id);
        return DataTables::eloquent($model)
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a href="' . route('admin.kritiksaran.edit', encrypt($row->id_kritik_saran)) . '" class="text-primary edit" tooltip="Edit Kritik/Saran"><i class="fas fa-pencil-alt mr-2"></i></a>';
                $btn .= '<a href="' . route('admin.kritiksaran.destroy', encrypt($row->id_kritik_saran)) . '" class="text-danger delete mr-2" tooltip="Hapus Kritik/Saran"><i class="far fa-trash-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();
    }
    public function pengguna()
    {
        $model = User::query();
        // dd(Auth::user()->id);
        return DataTables::eloquent($model)
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a href="' . route('admin.pengguna.edit', encrypt($row->id)) . '" class="text-primary edit" tooltip="Edit Pengguna"><i class="fas fa-pencil-alt mr-2"></i></a>';
                if($row->id != 1){
                    $btn .= '<a href="' . route('admin.pengguna.destroy', encrypt($row->id)) . '" class="text-danger delete mr-2" tooltip="Hapus Pengguna"><i class="far fa-trash-alt"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();
    }
    public function menu()
    {
        $model = MMenu::with('pages');
        $menu = MMenu::all();
        // dd($model);
        return DataTables::eloquent($model)
            ->addColumn('status', function ($row) {
                $result = "";
                if($row->aktif == 1){
                    $result = '<span class="badge badge-success">Aktif</span>';
                }else{
                    $result = '<span class="badge badge-danger">Non Aktif</span>';
                }
                return $result;
            })
            ->addColumn('url', function ($row) {
                $result = "-";
                if($row->pages != null){
                    $result = '<a target="_blank" href="'.url($row->pages->url).'">'.$row->pages->url.'</a>';
                }
                return $result;
            })
            ->editColumn('parent', function ($row) use ($menu) {
                foreach ($menu as $key) {
                    if($row->parent == $key->id_menu){
                        return $key->title;
                    }
                }
                return "-";
            })
            ->addColumn('action', function ($row) {
                $btn = '';
                if($row->tipe == 0){
                    $btn .= '<a href="' . route('admin.menu.edit', encrypt($row->id_menu)) . '" class="text-primary edit" tooltip="Edit Menu"><i class="fas fa-pencil-alt mr-2"></i></a>';
                    if($row->id_menu != 1){
                        $btn .= '<a href="' . route('admin.menu.destroy', encrypt($row->id_menu)) . '" class="text-danger delete mr-2" tooltip="Hapus Menu"><i class="far fa-trash-alt"></i></a>';
                    }
                }
                return $btn;
            })
            ->rawColumns(['action', 'status','url'])
            ->addIndexColumn()
            ->toJson();
    }
    public function perangkatdesa()
    {
        $model = MPerangkatDesa::query();
        // dd(Auth::user()->id);
        return DataTables::eloquent($model)
            ->editColumn('foto_conv', function ($row) {
                return '<img src="'.asset('image/perangkat-desa/'.$row->foto).'" width="100px" alt="">';
            })
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a href="' . route('admin.perangkat_desa.edit', encrypt($row->id_kritik_saran)) . '" class="text-primary edit" tooltip="Edit Kritik/Saran"><i class="fas fa-pencil-alt mr-2"></i></a>';
                $btn .= '<a href="' . route('admin.perangkat_desa.destroy', encrypt($row->id_kritik_saran)) . '" class="text-danger delete mr-2" tooltip="Hapus Kritik/Saran"><i class="far fa-trash-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action', 'foto_conv'])
            ->addIndexColumn()
            ->toJson();
    }
}
