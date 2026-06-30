<?php

namespace Modules\Chama\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Chama\Entities\ChamaGroup;
use Modules\Chama\Entities\ChamaMember;
use Modules\Client\Entities\ClientUser;

class MemberChamaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', '2fa']);
    }

    public function index()
    {
        $client_ids = ClientUser::where('user_id', Auth::id())->pluck('client_id');
        $chamas = ChamaMember::whereIn('client_id', $client_ids)->with('group')->get();
        return theme_view('chama::themes.adminlte.chama.member_index', compact('chamas'));
    }

    public function show($id)
    {
        $group = ChamaGroup::with(['members.client', 'contributions', 'payouts'])->find($id);
        // Ensure user belongs to this chama
        $client_ids = ClientUser::where('user_id', Auth::id())->pluck('client_id');
        $my_memberships = ChamaMember::where('chama_group_id', $id)->whereIn('client_id', $client_ids)->get();

        if($my_memberships->isEmpty()) {
             abort(403, "You do not belong to this Chama.");
        }

        $my_contributions = \Modules\Chama\Entities\ChamaContribution::where('chama_group_id', $id)
            ->whereIn('chama_member_id', $my_memberships->pluck('id'))
            ->orderBy('date', 'desc')
            ->get();

        return theme_view('chama::themes.adminlte.chama.member_show', compact('group', 'my_contributions'));
    }
}
