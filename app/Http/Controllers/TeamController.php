<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function create()
    {
        $users = User::all();
        return view('team.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_name' => 'required|string|max:255',
            'team_leader_id' => 'required|exists:users,id',
            'team_member_ids' => 'required|array',
        ]);

        Team::create([
            'team_name' => $request->team_name,
            'team_leader_id' => $request->team_leader_id,
            'team_member_ids' => json_encode($request->team_member_ids),
        ]);

        return redirect()->route('team.index');
    }

    public function index()
    {
        $teams = Team::with('teamLeader')->get();
        $teamLeaders = User::role('team leader')->get();
        $teamMembers = User::role('team member')->get();

        return view('team.team', compact('teams', 'teamLeaders', 'teamMembers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'team_name' => 'required|string|max:255',
            'team_leader_id' => 'required|exists:users,id',
            'team_member_ids' => 'required|array',
        ]);

        $team = Team::findOrFail($id);
        $team->update([
            'team_name' => $request->team_name,
            'team_leader_id' => $request->team_leader_id,
            'team_member_ids' => json_encode($request->team_member_ids),
        ]);

        return redirect()->route('team.index');
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return redirect()->route('team.index');
    }
}