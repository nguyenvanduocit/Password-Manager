<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function index()
    {

        $groups = Auth::user()->groups()->paginate(10);
        return view('group.index', ['groups' => $groups]);
    }

    public function create()
    {
        return view('group.create');
    }

    public function store()
    {
        $rules = [
            'name' => 'required'
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()
                           ->withErrors($validator)
                           ->withInput();
        } else {
            $group = new Group(Input::only(['name', 'description']));
            $group->save();

            $memberDatas = [];
            $members = Input::has('members')?Input::get('members'):[];
            foreach ($members as $member){
                $memberDatas[$member] = ['is_owner'=>0];
            }

            $owners = Input::has('owners')?Input::get('owners'):[];
            foreach ($owners as $owner){
                $memberDatas[$owner] = ['is_owner'=>1];
            }
            $memberDatas[Auth::user()->id] = ['is_owner'=>1];
            $group->members()->sync($memberDatas);

            return Redirect::to(route('group.edit', ['groupId' => $group->id]))->with(['success_message'=>'Created!']);
        }
    }

    public function edit($groupId)
    {
        $group = Group::with(['owners', 'members'])->findOrFail($groupId);
        $this->authorize('update', $group);
        return view('group.edit', ['group' => $group]);
    }

    public function update($groupId)
    {
        $rules = [
            'name' => 'required'
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()
                           ->withErrors($validator)
                           ->withInput();
        }
        $group = Group::with(['owners', 'members'])->findOrFail($groupId);
        $this->authorize('update', $group);
        $group->name = Input::get('name');
        $group->description = Input::get('description');

        $memberDatas = [];
        $members = Input::has('members')?Input::get('members'):[];
        foreach ($members as $member){
            $memberDatas[$member] = ['is_owner'=>0];
        }

        $owners = Input::has('owners')?Input::get('owners'):[];
        foreach ($owners as $owner){
            $memberDatas[$owner] = ['is_owner'=>1];
        }
        $group->members()->sync($memberDatas);

        $group->save();
        return Redirect::back()->with(['success_message'=>'Updated!']);
    }

    public function destroy($groupId){
        $group = Group::findOrFail($groupId);
        $this->authorize('destroy', $group);
        $group->delete();
        return Redirect::to(route('group.index'))->with(['success_message'=>'Deleted!']);
    }
}
