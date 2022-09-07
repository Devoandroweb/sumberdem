@extends('app')
<style>
    #gmap_canvas,.gmap_canvas,.mapouter{
        width: 100% !important;
        
    }
</style>
@section('content')
<?php 
use App\Traits\Helper;  

$name[] = 'foto';
$name[] = 'nama';
$name[] = 'jabatan';
$name[] = 'facebook';
$name[] = 'instagram';
$name[] = 'email';

?>

<div class="card  card-outline card-primary">
    <div class="card-header d-flex align-items-center">
        <h3 class="card-title">Isikan dengan data yang sesuai</h3>
        <div class="card-tools ml-auto">
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
            </button>
        </div>
    </div>
    
    <div class="card-body">
       
        <form action="{{$url}}" method="post" enctype="multipart/form-data">
            @csrf
            {{$method != null ? $method : ''}}
            <div class="row">
                <div class="col-md-12">
                    <label for="">Foto</label>
                    <div class="image-live" data-target="foto" data-ext="png,jpg,jpeg">
                        <input type="file" class="d-none file-live" name="foto">
                       @if (Helper::showData($data,$name[0]) != null)
                            <input type="text" class="d-none" value="{{Helper::showData($data,$name[0])}}" name="{{$name[0]}}-old">
                            <img id="{{$name[0]}}" src="{{asset('image/pages/'.$data->cover_image)}}"  style="width: 200px;" class="shadow rounded mb-4 img-fluid" alt="{{$data[$name[1]]}}" srcset="">
                        @else
                            <img id="{{$name[0]}}" src="{{asset('assets/dist/img/600x700.png')}}"  style="width: 200px;" class="shadow rounded mb-4 img-fluid" alt="" srcset="">
                        @endif
                    </div>
                    <div class="text-danger mb-4"><small><i>File Tidak Boleh Lebih besar dari 1Mb</i></small></div>
                </div>
                <div class="form-group col-md-12">
                    <label for="">Nama</label>
                    <input type="text" class="form-control @error($name[1]) is-invalid @enderror"
                        value="{{Helper::showData($data,$name[1])}}" name="{{$name[1]}}" autocomplete="off" />
                </div>
                <div class="form-group col-md-12">
                    <label for="">Jabatan</label>
                    <input type="text" class="form-control @error($name[2]) is-invalid @enderror"
                        value="{{Helper::showData($data,$name[2])}}" name="{{$name[2]}}" autocomplete="off" />
                </div>

                <div class="form-group col-md-12">
                    <label for="">Facebook</label>
                    <input type="text" class="form-control @error($name[3]) is-invalid @enderror"
                        value="{{Helper::showData($data,$name[3])}}" name="{{$name[3]}}" autocomplete="off" />
                </div>
                <div class="form-group col-md-12">
                    <label for="">Instagram</label>
                    <input type="text" class="form-control @error($name[4]) is-invalid @enderror"
                        value="{{Helper::showData($data,$name[4])}}" name="{{$name[4]}}" autocomplete="off" />
                </div>
                <div class="form-group col-md-12">
                    <label for="">Email</label>
                    <input type="text" class="form-control @error($name[5]) is-invalid @enderror"
                        value="{{Helper::showData($data,$name[5])}}" name="{{$name[5]}}" autocomplete="off" />
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                <a href="" onclick="history.back()" class="btn btn-default">Kembali</a>
            </div>
        </form>
    </div>
</div>

@endsection
