@extends('core::layouts.master')
@section('title')
    Chama Groups
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chama Groups</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Chama Groups</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{ url('chama/group/create') }}" class="btn btn-info btn-sm">
                    <i class="fas fa-plus"></i> Add Group
                </a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover" id="chama-groups-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Frequency</th>
                        <th>Start Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $('#chama-groups-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! url('chama/group/get_groups') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'contribution_amount', name: 'contribution_amount'},
                {data: 'frequency', name: 'frequency'},
                {data: 'start_date', name: 'start_date'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            "order": [[0, "desc"]]
        });
    </script>
@endsection
