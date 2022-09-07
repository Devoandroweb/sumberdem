@extends('app')
<style>
    #gmap_canvas,.gmap_canvas,.mapouter{
        width: 100% !important;
        
    }
</style>
@section('content')
<?php 
use App\Traits\Helper;  

$name[] = 'title';
$name[] = 'label';
$name[] = 'id_pages';
$name[] = 'parent';
$name[] = 'aktif';

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
                    <label for="">Title</label>
                    <input type="text" class="form-control @error($name[0]) is-invalid @enderror"
                        value="{{Helper::showData($data,$name[0])}}" name="{{$name[0]}}" autocomplete="off" />
                </div>
                <div class="form-group col-md-12">
                    <label for="">Label</label>
                    <input type="text" class="form-control @error($name[1]) is-invalid @enderror"
                        value="{{Helper::showData($data,$name[1])}}" name="{{$name[1]}}" autocomplete="off" />
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Url</label>
                    <select id="pages" class="form-control @error($name[2]) is-invalid @enderror"
                        name="{{$name[2]}}" autocomplete="off">
                        <option value="" selected disabled> Pilih Url (Halaman)</option>
                        @if($data != null)
                        <option value="0" {{($data->id_pages == 0) ? 'selected' : ''}}> Tanpa Url</option>
                        @else
                        <option value="0"> Tanpa Url</option>
                        @endif

                        @foreach($pages as $key)
                        <option value="<?= $key->{$name[2]} ?>"
                            {{(old($name[2]) == $key->{$name[2]}) ? 'selected' : ''}}
                            {{Helper::showDataSelected($data,$name[2],$key->{$name[2]})}}>
                            {{$key->title}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Parent</label>
                    <select id="menu" class="form-control @error($name[3]) is-invalid @enderror"
                        name="{{$name[3]}}" autocomplete="off">
                        <option value="" selected disabled> Pilih Parent (dari Menu yang sudah ada)</option>
                        @if($data != null)
                        <option value="0" {{($data->parent == 0) ? 'selected' : ''}}> Tidak Ada</option>
                        @else
                        <option value="0"> Tidak Ada</option>
                        @endif
                        @foreach($menus as $key)
                            @if($data != null)
                                @if($key->id_menu != $data->id_menu)
                                <option value="<?= $key->id_menu ?>"
                                    {{(old($name[3]) == $key->id_menu) ? 'selected' : ''}}
                                    {{Helper::showDataSelected($data,$name[3],$key->id_menu)}}>
                                    {{$key->title}}
                                </option>
                                @endif
                            @else
                                <option value="<?= $key->id_menu ?>"
                                    {{(old($name[3]) == $key->id_menu) ? 'selected' : ''}}
                                    {{Helper::showDataSelected($data,$name[3],$key->id_menu)}}>
                                    {{$key->title}}
                                </option>
                            @endif
                            
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" name="{{$name[4]}}" value="1" class="custom-control-input" id="customSwitch1" 
                      {{(old($name[4]) == 1) ? 'checked' : ''}}
                      {{Helper::showDataChecked($data,$name[4],1)}}>
                      <label class="custom-control-label" for="customSwitch1">Aktif</label>
                    </div>
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