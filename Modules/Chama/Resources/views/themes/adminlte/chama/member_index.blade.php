@extends('core::layouts.master')
@section('title')
    My Chamas
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <h1>My Chamas</h1>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contribution</th>
                        <th>Frequency</th>
                        <th>Payout Order</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($chamas as $chama)
                        <tr>
                            <td>{{ $chama->group->name }}</td>
                            <td>{{ number_format($chama->group->contribution_amount, 2) }}</td>
                            <td>{{ $chama->group->frequency }}</td>
                            <td>{{ $chama->payout_order }}</td>
                            <td>
                                <a href="{{ url('portal/chama/' . $chama->group->id . '/show') }}" class="btn btn-info btn-xs">View Details</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
