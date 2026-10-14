@extends('core::layouts.master')
@section('title')
    {{ trans_choice('client::general.client',2) }}
@endsection
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@stop
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ trans_choice('client::general.client',2) }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                    href="{{url('dashboard')}}">{{ trans_choice('dashboard::general.dashboard',1) }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans_choice('client::general.client',2) }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans_choice('client::general.client',2) }}</h3>

                <div class="card-tools">
                    <a href="{{ url('client/create') }}" class="btn btn-info btn-sm">
                        <i class="fas fa-plus"></i> {{ trans_choice('core::general.add',1) }} {{ trans_choice('client::general.client',1) }}
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table  table-striped table-hover table-condensed" id="data-table">
                <thead>
                <tr>
                    <th>{{ trans_choice('core::general.name',1) }}</th>
                    <th>{{ trans_choice('core::general.system',1) }} {{ trans_choice('core::general.id',1) }}</th>
                    <th>{{ trans_choice('core::general.external_id',1) }}</th>
                    <th>{{ trans('core::general.gender') }}</th>
                    <th>{{ trans('core::general.mobile') }}</th>
                    <th>{{ trans_choice('core::general.status',1) }}</th>
                    <th>{{ trans_choice('core::general.branch',1) }}</th>
                    <th>{{ trans_choice('core::general.staff',1) }}</th>
                    <th>{{ trans_choice('core::general.action',1) }}</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! url('client/get_clients') !!}',
            columns: [
                {data: 'name', name: 'clients.first_name'},
                {data: 'id', name: 'id'},
                {data: 'external_id', name: 'external_id'},
                {data: 'gender', name: 'gender'},
                {data: 'mobile', name: 'mobile'},
                {data: 'status', name: 'status'},
                {data: 'branch', name: 'branches.name'},
                {data: 'staff', name: 'users.first_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            "order": [[0, "desc"]],
            "language": {
                "lengthMenu": "{{ trans('general.lengthMenu') }}",
                "zeroRecords": "{{ trans('general.zeroRecords') }}",
                "info": "{{ trans('general.info') }}",
                "infoEmpty": "{{ trans('general.infoEmpty') }}",
                "search": "{{ trans('general.search') }}",
                "infoFiltered": "{{ trans('general.infoFiltered') }}",
                "paginate": {
                    "first": "{{ trans('general.first') }}",
                    "last": "{{ trans('general.last') }}",
                    "next": "{{ trans('general.next') }}",
                    "previous": "{{ trans('general.previous') }}"
                }
            },
            responsive: false
        });
    </script>
@endsection
