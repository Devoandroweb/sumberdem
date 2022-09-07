@extends('app')
@section('content')
<div class="row">
    <div class="col-12">
        <form action="{{url('admin/vidio/update')}}" method="post">
            @csrf
            <div class="card card-outline card-info">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title">
                        Galery Vidio
                    </h4><br>
                    <div class="card-tools ml-auto">
                        <span class="dropdown">
                            <a class="" data-toggle="dropdown" href="#" aria-expanded="false">
                                <i class="fas fa-question-circle"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right" style="left: inherit; right: 0px;min-width:500px !important">
                                <img src="{{asset('assets/dist/img/help-vidio.png')}}" alt="" class="img-fluid w-100">
                            </div>
                        </span>
                        <button type="button" class="btn btn-tool " data-card-widget="maximize"><i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col data">
                            @forelse ($data as $item)
                                <div class="input-group mb-3">
                                    <input type="text" name="vidio[]" class="form-control"  value="{{$item->embed}}" placeholder="Masukkan Kode Vidio Youtube disini">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger"><i class="fas fa-times-circle"></i></button>
                                    </div>
                                </div>
                            @empty
                                <div class="input-group mb-3">
                                    <input type="text" name="vidio[]" class="form-control" placeholder="Masukkan Kode Vidio Youtube disini">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger"><i class="fas fa-times-circle"></i></button>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="col-1 position-relative">
                            <button type="button" class="btn btn-success position-absolute mb-3 btn-add-field" style="bottom:0;"><i class="fas fa-plus-circle"></i></button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
    
</div>
@endsection
@push('js')
@if(session('msg'))
<script>
    iziToast.success({
        title: 'Success',
        message: "{{session('msg')}}",
        position: 'bottomCenter'
    });
</script>
@endif
<script>
    $('.btn-add-field').click(function (e) { 
        e.preventDefault();
        var html = '<div class="input-group mb-3">\
                            <input type="text" name="vidio[]" class="form-control" placeholder="Masukkan Kode Vidio Youtube disini">\
                            <div class="input-group-append">\
                                <button type="button" name="vidio[]" class="btn btn-danger"><i class="fas fa-times-circle"></i></button>\
                            </div>\
                        </div>';
        $(".data").append(html);
        
    });
</script>
@endpush