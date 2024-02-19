<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;


class MemberController extends Controller
{
    public function create_members(Request $request) {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Name is required',
            'phone.required' => 'Phone is required',
        ]);

        $member = new Member();
        $member->name = $request->name;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->address = $request->address;
        $member->save();

        return redirect()->route('members');
    }

    public function update_members(Request $request) {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Name is required',
            'phone.required' => 'Phone is required',
        ]);

        $member = Member::find($request->id);
        $member->name = $request->name;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->address = $request->address;
        $member->save();

        return redirect()->route('members');
    }

    public function delete_members(Request $request) {
        $member = Member::find($request->id);
        $member->delete();

        return redirect()->route('members');
    }

    public function read_members(Request $request) {
        $members = Member::all();
        return view('members', ['members' => $members]);
    }
}