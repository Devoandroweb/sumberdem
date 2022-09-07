@extends('app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">{{$subTitle}}</h3>
                <div class="card-tools">
                  <a href="{{route('admin.kritiksaran.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data" class="table table-striped" width="100%">
                        <thead>
                            <tr>
                            <th class="text-center">
                                #
                            </th>
                            <th>Nama Pengunjung</th>
                            <th>No Telp</th>
                            <th>Email</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
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
    var _URL_DATATABLE = '{{ url("datatable/kritiksaran") }}';
    setDataTable();
    function setDataTable() {
        $('#data').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: _URL_DATATABLE,
            },
            responsive: true,
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    width: '4%',
                    className: 'text-center'
                },{
                    data: 'nama_pengunjung',
                    name: 'nama_pengunjung',
                },{
                    data: 'no_telp',
                    name: 'no_telp',
                },{
                    data: 'email',
                    name: 'email',
                },{
                    data: 'deskripsi',
                    name: 'deskripsi',
                },{
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }]
        });
    }
</script>
<script type="text/javascript" src="{{asset('/')}}assets/dist/js/delete.js"></script>

@endpush
