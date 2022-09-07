@extends('app')
<style>
    [data-toggle="lightbox"],.delete-img{
        outline: none;
    }
    .delete-img:hover{
        color: rgb(236, 20, 20) !important;
    }
</style>
@section('content')
<div class="row">
    <div class="col-12">
    <div class="card card-outline card-info">
        <div class="card-header d-flex align-items-center">
            <h4 class="card-title">Galery Foto</h4><br>
            <div class="card-tools ml-auto">
                <a href="{{route('admin.foto.create')}}" class="btn btn-info mr-2"><i class="fas fa-plus-circle"></i> Tambah Foto</a>
                <button type="button" class="btn btn-tool " data-card-widget="maximize"><i class="fas fa-expand"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="data-foto"></div>
        </div>
    </div>
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
    var _DATA_FOTO = <?= ($data != null) ? json_encode($data) : [] ?>;
    generateDataFoto();
    console.log(_DATA_FOTO);
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });
    $(document).on('click','.delete',function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Kamu Yakin?',
            text: "Menghapus data ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
            }).then((result) => {
            if (result.isConfirmed) {
                deleteData($(this).attr('href'),'post',{_method:'delete'});
            }
        })
    });
    function deleteData(url,type = "get",method = null){
        $.ajax({
            type: type,
            url: url,
            data : method,
            dataType: "JSON",
            success: function (response) {
                if(response.status){
                    iziToast.success({
                        title: 'Success',
                        message: response.msg,
                        position: 'bottomCenter'
                    });
                    _DATA_FOTO = response.data;
                    generateDataFoto();
                }
            }
        });
    }
    function generateDataFoto(){
        var html = "";
        var urlDelete = "{{url('admin/foto/')}}";
        html += '<div class="row">';
        _DATA_FOTO.forEach(e => {
            var urlImg = "{{asset('image/foto/')}}/"+e.image;
            html += ' <div class="col-sm-3 mb-2 position-relative">\
                <a href="'+urlImg+'" data-toggle="lightbox" data-title="" data-gallery="gallery">\
                    <img src="'+urlImg+'" class="img-fluid shadow rounded w-100 mb-2" alt="white sample"/>\
                </a>\
                <a href="'+urlDelete+'/'+e.id_foto+'" class="text-white delete delete-img position-absolute" style="top:10px;right:15px;" tooltip="Hapus Foto"><i class="fas fa-times-circle"></i></a>\
            </div>'
        });
           
           
        html += '</div>';
        $(".data-foto").html(html);
    }
</script>
@endpush