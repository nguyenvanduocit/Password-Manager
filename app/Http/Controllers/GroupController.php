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

        $groups = Auth::user()->ownerGroups()->paginate(10);
        return view('group.index', ['groups' => $groups]);
    }
    public function create()
    {
        return view('group.create');
    }
    public function store()
    {
        $rules = [
            'name' => 'required|unique:groups',
            'description' => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()
                           ->withErrors($validator)
                           ->withInput();
        } else {
            $group = new Group(Input::only(['name', 'description']));
            $currentUser = Auth::user();
            $currentUser->ownerGroups()->save($group);
            return Redirect::to(route('group.edit', ['groupId' => $group->id]))->with(['success_message'=>'Created!']);
        }
    }
    public function edit($groupId)
    {
        $group = Group::with(['owner', 'members'])->findOrFail($groupId);
        if (Gate::denies('update', $group)) {
            abort(403);
        }

        return view('group.edit', ['group' => $group]);
    }
    public function update($groupId)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()
                           ->withErrors($validator)
                           ->withInput();
        }
        $group = Group::with(['owner', 'members'])->findOrFail($groupId);
        if (Gate::denies('update', $group)) {
            abort(403);
        }
        $group->name = Input::get('name');
        $group->description = Input::get('description');
        $group->save();
        \Session::flash('message', 'Update Success');

        return Redirect::back();
    }
    public function destroy($groupId){
        $group = Group::findOrFail($groupId);
        if (Gate::denies('destroy', $group)) {
            abort(403);
        }
        $group->delete();
        return Redirect::to(route('group.index'))->with(['success_message'=>'Deleted!']);
    }
}
