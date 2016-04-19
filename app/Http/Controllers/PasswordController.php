<?php

namespace App\Http\Controllers;

use App\Group;
use App\Password;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
	public function index(){

		$selectedGroup = null;
		if($groupId = Input::get('group')){
			$selectedGroup = Group::find($groupId);
		}
		if($selectedGroup){
			if (Gate::denies('show', $selectedGroup)) {
				return Redirect::back()->with(['error_message'=>"You do not have permission."]);
			}
			$passwords = $selectedGroup->passwords()->paginate( 10 );
		}
		else{
			$passwords = Auth::user()->passwords()->paginate( 10 );
		}
		$groups = Auth::user()->groups()->get();
		return view('password.index',['passwords'=>$passwords, 'groups'=>$groups, 'selectedGroup'=>$selectedGroup]);
	}

	public function create(){

		$groups = Auth::user()->groups()->get();
		return view('password.create',['groups'=>$groups]);
	}

	public function store(){
		$rules = [
			'title'=>'required',
			'email'=>'required',
			'password'=>'required'
		];
		$validator = Validator::make(Input::all(), $rules);
		if ( $validator->fails() ) {
			return Redirect::back()
			               ->withErrors( $validator )
			               ->withInput();
		}else{
			$password = Auth::user()->passwords()->create(Input::only(['title','username','email','password','note','url']));
			if(Input::get('groups')){
				$password->groups()->sync(Input::get('groups'));
			}
			$password->save();
			return Redirect::to(route('password.show',['id'=>$password->id]));
		}
	}

	public function edit($passwordId){
		$password = Password::with([
			'groups'=>function($query){
				$query->select('id');
			}
		])->findOrFail($passwordId);
		$groups = Auth::user()->ownerGroups()->get();
		$this->authorize('destroy', $password);
		$selectedGroups =[];
		foreach ($password->groups as $group){
			$selectedGroups[] = $group->id;
		}
		return view('password.edit',['password'=>$password, 'groups'=>$groups, 'selectedGroup'=>$selectedGroups]);
	}
	
	public function update($passwordId){
		$rules = [
			'title'=>'required',
			'password'=>'required'
		];
		$validator = Validator::make(Input::all(), $rules);
		if($validator->fails()){
			return Redirect::back()
			               ->withErrors( $validator )
			               ->withInput();
		}
		$password = Password::findOrFail($passwordId);
		$this->authorize('destroy', $password);
		$password->title = Input::get('title');
		$password->email = Input::get('email');
		$password->password = Input::get('password');
		$password->username = Input::get('username');
		$password->note = Input::get('note');
		$password->url = Input::get('url');
		if(Input::get('groups') == null){
			$password->groups()->detach();
		}else{
			$password->groups()->sync(Input::get('groups'));
		}
		$password->save();
		return Redirect::back();
	}

	public function show($passwordId){
		$password = Password::with(['owner', 'groups'])->findOrFail($passwordId);
		$this->authorize('update', $password);
		return view('password.show', ['password'=>$password]);
	}

	public function destroy($passwordId){
		$password = Password::findOrFail($passwordId);
		$this->authorize('destroy', $password);
		$password->delete();
		return Redirect::to(route('password.index'))->with(['success_message'=>'Deleted.']);
	}
}
