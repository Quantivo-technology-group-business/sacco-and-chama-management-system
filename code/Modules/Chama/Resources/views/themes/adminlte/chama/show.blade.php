@extends('core::layouts.master')
@section('title')
    Chama Group Details
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $group->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{url('chama/group')}}">Chama Groups</a></li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Member</h3>
                    </div>
                    <form method="post" action="{{ url('chama/group/' . $group->id . '/add_member') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="client_id">Client</label>
                                <select name="client_id" class="form-control select2" required>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->first_name }} {{ $client->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="payout_order">Payout Order</label>
                                <input type="number" name="payout_order" class="form-control" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info btn-block">Add Member</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Members & Payout Schedule</h3>
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
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Record Contribution</h3>
                    </div>
                    <form method="post" action="{{ url('chama/group/' . $group->id . '/store_contribution') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="chama_member_id">Member</label>
                                <select name="chama_member_id" class="form-control select2" required>
                                    @foreach($group->members as $member)
                                        <option value="{{ $member->id }}">{{ $member->client->first_name }} {{ $member->client->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="number" step="0.01" name="amount" class="form-control" value="{{ $group->contribution_amount }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Save Contribution</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Record Payout</h3>
                    </div>
                    <form method="post" action="{{ url('chama/group/' . $group->id . '/store_payout') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="chama_member_id">Member</label>
                                <select name="chama_member_id" class="form-control select2" required>
                                    @foreach($group->members as $member)
                                        <option value="{{ $member->id }}">{{ $member->client->first_name }} {{ $member->client->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="number" step="0.01" name="amount" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-block">Save Payout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Recent Contributions</h3>
                    </div>
                    <div class="card-body p-0">
                         <table class="table table-condensed table-striped">
                             <thead>
                             <tr>
                                 <th>Date</th>
                                 <th>Member</th>
                                 <th>Amount</th>
                             </tr>
                             </thead>
                             <tbody>
                             @foreach($group->contributions as $contribution)
                                 <tr>
                                     <td>{{ $contribution->date }}</td>
                                     <td>{{ $contribution->member->client->first_name }}</td>
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
                        <h3 class="card-title">Recent Payouts</h3>
                    </div>
                    <div class="card-body p-0">
                         <table class="table table-condensed">
                             <thead>
                             <tr>
                                 <th>Date</th>
                                 <th>Member</th>
                                 <th>Amount</th>
                             </tr>
                             </thead>
                             <tbody>
                             @foreach($group->payouts as $payout)
                                 <tr>
                                     <td>{{ $payout->date }}</td>
                                     <td>{{ $payout->member->client->first_name }}</td>
                                     <td>{{ number_format($payout->amount, 2) }}</td>
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
