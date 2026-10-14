<?php

namespace Modules\Chama\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Chama\Entities\ChamaGroup;
use Modules\Chama\Entities\ChamaMember;
use Modules\Chama\Entities\ChamaContribution;
use Modules\Chama\Entities\ChamaPayout;
use Modules\Client\Entities\Client;
use Yajra\DataTables\Facades\DataTables;

class ChamaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', '2fa']);
    }

    public function index()
    {
        return theme_view('chama::themes.adminlte.chama.index');
    }

    public function get_groups(Request $request)
    {
        $query = ChamaGroup::query();
        return DataTables::of($query)->editColumn('action', function ($data) {
            $action = '<div class="btn-group"><button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-navicon"></i></button> <ul class="dropdown-menu dropdown-menu-right" role="menu">';
            $action .= '<li><a href="' . url('chama/group/' . $data->id . '/show') . '" class="">Detail</a></li>';
            $action .= '<li><a href="' . url('chama/group/' . $data->id . '/edit') . '" class="">Edit</a></li>';
            $action .= '<li><a href="' . url('chama/group/' . $data->id . '/destroy') . '" class="confirm">Delete</a></li>';
            $action .= "</ul></li></div>";
            return $action;
        })->editColumn('id', function ($data) {
            return '<a href="' . url('chama/group/' . $data->id . '/show') . '">' . $data->id . '</a>';
        })->rawColumns(['id', 'action'])->make(true);
    }

    public function create()
    {
        return theme_view('chama::themes.adminlte.chama.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'contribution_amount' => 'required|numeric',
            'frequency' => 'required',
            'start_date' => 'required|date',
        ]);
        $group = new ChamaGroup();
        $group->name = $request->name;
        $group->description = $request->description;
        $group->contribution_amount = $request->contribution_amount;
        $group->frequency = $request->frequency;
        $group->start_date = $request->start_date;
        $group->created_by_id = Auth::id();
        $group->save();

        \flash("Successfully saved")->success()->important();
        return redirect('chama/group');
    }

    public function show($id)
    {
        $group = ChamaGroup::with(['members.client', 'contributions', 'payouts'])->find($id);
        $clients = Client::select('id', 'first_name', 'last_name')->get();
        return theme_view('chama::themes.adminlte.chama.show', compact('group', 'clients'));
    }

    public function edit($id)
    {
        $group = ChamaGroup::find($id);
        return theme_view('chama::themes.adminlte.chama.edit', compact('group'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'contribution_amount' => 'required|numeric',
            'frequency' => 'required',
            'start_date' => 'required|date',
        ]);
        $group = ChamaGroup::find($id);
        $group->name = $request->name;
        $group->description = $request->description;
        $group->contribution_amount = $request->contribution_amount;
        $group->frequency = $request->frequency;
        $group->start_date = $request->start_date;
        $group->status = $request->status;
        $group->save();

        \flash("Successfully updated")->success()->important();
        return redirect('chama/group');
    }

    public function destroy($id)
    {
        ChamaGroup::destroy($id);
        \flash("Successfully deleted")->success()->important();
        return redirect('chama/group');
    }

    public function add_member(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required',
            'payout_order' => 'required|integer',
        ]);
        $member = new ChamaMember();
        $member->chama_group_id = $id;
        $member->client_id = $request->client_id;
        $member->payout_order = $request->payout_order;
        $member->save();

        \flash("Member added successfully")->success()->important();
        return redirect()->back();
    }

    public function store_contribution(Request $request, $id)
    {
        $request->validate([
            'chama_member_id' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);
        $contribution = new ChamaContribution();
        $contribution->chama_group_id = $id;
        $contribution->chama_member_id = $request->chama_member_id;
        $contribution->amount = $request->amount;
        $contribution->date = $request->date;
        $contribution->notes = $request->notes;
        $contribution->created_by_id = Auth::id();
        $contribution->save();

        \flash("Contribution recorded successfully")->success()->important();
        return redirect()->back();
    }

    public function store_payout(Request $request, $id)
    {
        $request->validate([
            'chama_member_id' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);
        $payout = new ChamaPayout();
        $payout->chama_group_id = $id;
        $payout->chama_member_id = $request->chama_member_id;
        $payout->amount = $request->amount;
        $payout->date = $request->date;
        $payout->notes = $request->notes;
        $payout->created_by_id = Auth::id();
        $payout->save();

        \flash("Payout recorded successfully")->success()->important();
        return redirect()->back();
    }
}
