
@extends('app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card  card-outline card-primary">
            <div class="card-header d-flex align-items-center">
                <h3 class="card-title">Upload Galery Foto, bisa langsung banyak</h3>
                <div class="card-tools ml-auto">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('admin.foto.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="input-images" style="padding-top: .5rem;"></div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                        <a href="" onclick="history.back()" class="btn btn-default">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $('.input-images').imageUploader();
</script>
@endpush