@extends('core::layouts.master')
@section('title')
    Chama Details
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <h1>{{ $group->name }}</h1>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">My Contributions</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($my_contributions as $contribution)
                                    <tr>
                                        <td>{{ $contribution->date }}</td>
                                        <td>{{ number_format($contribution->amount, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
             <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Payout Rotation</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Order</th>
                                <th>Member</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($group->members as $member)
                                <tr>
                                    <td>{{ $member->payout_order }}</td>
                                    <td>{{ $member->client->first_name }} {{ $member->client->last_name }}</td>
                                    <td>{{ $member->status }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
