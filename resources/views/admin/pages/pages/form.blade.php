@extends('app')

@section('content')
<?php 
use App\Traits\Helper;  

$name[] = 'cover_image';
$name[] = 'title';
$name[] = 'deskripsi';
$name[] = 'tipe';
$name[] = 'maps';
$name[] = 'image';
$name[] = 'vidio';

?>
<style>
    #gmap_canvas,.gmap_canvas,.mapouter{
        width: 100% !important;
        
    }
</style>
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
            <div class="row justify-content-center mb-4">
                <div class="col">
                    <div class="image-live" data-target="{{$name[0]}}" data-ext="png,jpg,jpeg">
                        <input type="file" class="d-none file-live" name="{{$name[0]}}">
                        @if (Helper::showData($data,$name[0]) != null)
                            <input type="text" class="d-none" value="{{Helper::showData($data,$name[0])}}" name="{{$name[0]}}-old">
                            <img id="{{$name[0]}}" src="{{asset('image/pages/'.$data->cover_image)}}"  style="width: 100%;" class="shadow rounded mb-4 img-fluid" alt="{{$data[$name[1]]}}" srcset="">
                        @else
                            <img id="{{$name[0]}}" src="{{asset('assets/dist/img/template-600x300.png')}}"  style="width: 100%;" class="shadow rounded mb-4 img-fluid" alt="" srcset="">
                        @endif
                    </div>
                    <div class="text-danger"><i>File Tidak Boleh Lebih besar dari 1Mb</i></div>
                    <div class="text-dark"><i>Rekomendasi Ukuran 1920x1080 Pixel</i></div>

                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Judul</label>
                    <input type="text" class="form-control @error($name[1]) is-invalid @enderror"
                        value="{{Helper::showData($data,$name[1])}}" name="{{$name[1]}}" autocomplete="off" />
                </div>
                
                
                
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Deskripsi</label>
                    <textarea id="{{$name[2]}}" type="text" class="form-control @error($name[2]) is-invalid @enderror" cols="5"
                        rows="6" style="height:100px" value="" name="{{$name[2]}}"
                        autocomplete="off">{{Helper::showData($data,$name[2])}}</textarea>
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Tipe Halaman</label>
                    <select id="tipe_helaman" class="form-control @error($name[3]) is-invalid @enderror"
                        name="{{$name[3]}}" autocomplete="off">
                        <option value="" selected disabled> Pilih Tipe Halaman</option>
                        @foreach($tipes as $key)
                        <option value="<?= $key['id_tipe'] ?>"
                            {{(old($name[3]) == $key['id_tipe']) ? 'selected' : ''}}
                            {{Helper::showDataSelected($data,$name[3],$key['id_tipe'])}}>
                            {{$key['label']}}
                        </option>
                        @endforeach
                    </select>
                </div>
                {{-- galery --}}
                <div id="galery" class="w-100" style="display:none">
                    {{-- galery foto --}}
                    <div class="form-group col-md-12">
                        <label for="">Galery Foto</label>
                        <input type="hidden" name="imgremove">
                        <div class="input-images" style="padding-top: .5rem;"></div>
                        <div class="text-danger"><i>Rekomendasi Ukuran 600x700 Pixel</i></div>

                    </div>
                    {{-- end galery foto --}}
                    {{-- galery vidio --}}
                    <div class="form-group col-md-12">
                        <label for="">Galery Vidio</label>
                        <span class="dropdown">
                            <a class="" data-toggle="dropdown" href="#" aria-expanded="false">
                                <i class="fas fa-question-circle"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right" style="left: inherit;margin-left:300px;min-width:500px !important">
                                <img src="{{asset('assets/dist/img/help-vidio.png')}}" alt="" class="img-fluid w-100">
                            </div>
                        </span>
                        <div class="row">
                            <div class="col data">
                                @forelse ($vidios as $vidio)
                                @if($loop->iteration == 1)
                                    <div class="input-group mb-3">
                                        <input type="text" name="vidio[]" class="form-control" value="{{$vidio['nama_file']}}" placeholder="Masukkan Kode Vidio Youtube disini">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger disabled" disabled><i class="fas fa-times-circle"></i></button>
                                        </div>
                                    </div>
                                @else
                                    <div class="input-group mb-3">
                                        <input type="text" name="vidio[]" class="form-control" value="{{$vidio['nama_file']}}" placeholder="Masukkan Kode Vidio Youtube disini">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger btn-remove-vidio" ><i class="fas fa-times-circle"></i></button>
                                        </div>
                                    </div>
                                @endif
                                @empty
                                <div class="input-group mb-3">
                                    <input type="text" name="vidio[]" class="form-control" placeholder="Masukkan Kode Vidio Youtube disini">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger disabled" disabled><i class="fas fa-times-circle"></i></button>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                            <div class="col-1 position-relative">
                                <button type="button" class="btn btn-success position-absolute mb-3 btn-add-field-vidio" style="bottom:0;height: 38px;"><i class="fas fa-plus-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    {{-- end galery vidio --}}
                </div>
                {{-- end galery --}}
                {{-- maps --}}
                <div class="maps col-md-12">
                    <div class="form-group">
                     <label for="exampleInputEmail1">Embed Goggle Maps, Klik <a target="_blank" href="https://google-map-generator.com/">disini</a> untuk mendapatkan Embed Maps</label>
                    <textarea name="maps" class="form-control w-100 mb-4" placeholder="Masukkan Embed Google Maps di sini" autocomplete="off">{{Helper::showData($data,$name[4])}}</textarea>
                    </div>
                    <div id="map">{!!Helper::showData($data,$name[4])!!}</div>
                </div>
                {{-- end maps --}}
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                <a href="" onclick="history.back()" class="btn btn-default">Kembali</a>
            </div>
        </form>
    </div>
</div>

@endsection
@push('js')
<script>
    var images = {{ Illuminate\Support\Js::from($images) }}
    var _IMG_REMOVE = [];

    // console.log(images);
    @if($data != null)
    openGalery(parseInt('{{$data->tipe}}'));
    @endif
    $(".maps textarea").change(function (e) { 
        e.preventDefault();
        $(".maps").find("#map").html($(this).val());
    });
    setEditorText("#{{$name[2]}}");

    $('.input-images').imageUploader({
        preloaded:images,preloadedInputName: 'imagesold'
    });
    $('.btn-add-field-vidio').click(function (e) { 
        e.preventDefault();
        var html = '<div class="input-group mb-3">\
                            <input type="text" name="vidio[]" class="form-control" placeholder="Masukkan Kode Vidio Youtube disini">\
                            <div class="input-group-append">\
                                <button type="button" name="vidio[]" class="btn btn-danger btn-remove-vidio"><i class="fas fa-times-circle"></i></button>\
                            </div>\
                        </div>';
        $(".data").append(html);
    });
    $(document).on('click','.btn-remove-vidio',function () {
        $(this).closest('.input-group').remove();
    });
    
    
    $('.delete-image').click(function (e) { 
        _IMG_REMOVE.push($(this).siblings('input').val());
        console.log(_IMG_REMOVE);
        $("input[name=imgremove]").val(_IMG_REMOVE);
    });

    $('#tipe_helaman').change(function (e) { 
        openGalery($(this).val());
    });
    function openGalery(value){
        // e.preventDefault();
        var tipe = [2,4];
        if(inArray(value,tipe)){
            $("#galery").show();
        }else{
            $("#galery").hide();
        }
    }

</script>
@endpush