<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\MKritikSaran;
use App\Models\MPages;
use App\Models\MPerangkatDesa;
use Illuminate\Http\Request;

class CIndex extends Controller
{
    function index()
    {
        $pages = MPages::where('tipe',2)->get();
        $visiMisi = MPages::where('tipe',1)->first();
        $kampungWisata = MPages::where('tipe',4)->get();
        
        return view('client.index',compact('pages', 'visiMisi', 'kampungWisata'));
    }
    public function detailPages($slug)
    {

        $data = MPages::where('slug',$slug)->with('galery')->first();
        // dd(count($data->galery));
        return view('client.detail', compact('data'));

    }
    public function kritiksaran()
    {
        return view('client.kritiksaran');
    }
    function saveKritik(Request $request)
    {
        try {
            //code...
            MKritikSaran::create($request->except('_token'));
            return response()->json(['status'=>true,'msg'=>'Terima Kasih atas Kritik dan Saran anda']);
        } catch (\Throwable $th) {
            return response()->json(['status'=>false,'msg'=>$th->getMessage()]);
            //throw $th;
        }
    }
    public function perangkatdesa()
    {
        $perangkat = MPerangkatDesa::all();
        return view('client.perangkat-desa', compact('perangkat'));
    }
}
