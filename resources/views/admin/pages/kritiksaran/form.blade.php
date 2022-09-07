@extends('app')
<style>
    #gmap_canvas,.gmap_canvas,.mapouter{
        width: 100% !important;
        
    }
</style>
@section('content')
<?php 
use App\Traits\Helper;  

$name[] = 'nama_pengunjung';
$name[] = 'no_telp';
$name[] = 'email';
$name[] = 'deskripsi';

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
                <div class="form-group col-md-12">
                    <label for="">Nama Pengunjung</label>
                    <input type="text" class="form-control @error($name[0]) is-invalid @enderror"
                        value="{{Helper::showData($data,$name[0])}}" name="{{$name[0]}}" autocomplete="off" />
                </div>
                <div class="form-group col-md-12">
                    <label for="">No Telepon</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+62</span>
                        </div>
                        <input type="text" name="{{$name[1]}}"  class="form-control @error($name[1]) is-invalid @enderror" value="{{Helper::showData($data,$name[1])}}" data-inputmask='"mask": "999-9999-9999"' placeholder="___-____-____" data-mask autocomplete="off" required>
                        
                    </div>
                    
                </div>

                <div class="form-group col-md-12">
                    <label for="">Email</label>
                    <input type="email" class="form-control @error($name[2]) is-invalid @enderror"
                        value="{{Helper::showData($data,$name[2])}}" name="{{$name[2]}}" autocomplete="off" />
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Deskripsi</label>
                    <textarea type="text" class="form-control @error($name[3]) is-invalid @enderror" cols="5"
                        rows="6" style="height:100px" value="" name="{{$name[3]}}"
                        autocomplete="off">{{Helper::showData($data,$name[3])}}</textarea>
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
@push('library-js')

@endpush
@push('js')
<script>
    $(".maps textarea").change(function (e) { 
        e.preventDefault();
        $(".maps").find("#map").html($(this).val());
    });
    setEditorText("#{{$name[2]}}");
</script>
@endpush