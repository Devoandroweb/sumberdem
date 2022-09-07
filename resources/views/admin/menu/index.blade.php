@extends('app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">{{$subTitle}}</h3>
                <div class="card-tools">
                  <a href="{{route('admin.menu.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Tambah</a>
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
                            <th>Title</th>
                            <th>Label</th>
                            <th>Url</th>
                            <th>Parent</th>
                            <th>Status</th>
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
    var _URL_DATATABLE = '{{ url("datatable/menu") }}';
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
                    data: 'title',
                    name: 'title',
                },{
                    data: 'label',
                    name: 'label',
                },{
                    data: 'url',
                    name: 'pages.url',
                },{
                    data: 'parent',
                    name: 'parent',
                },{
                    data: 'status',
                    name: 'status',
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
