<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
	/**
	 * Search action
	 * @param $username
	 *
	 * @return mixed
	 */
    public function search(){
	    $username = Input::get('name');
	    $foundUsers = DB::table('users')->where('name', 'like', "%$username%")->select(['id', 'name', 'email'])->get();
		if(Request::ajax()){
			return Response::json(['users'=>$foundUsers, 'total_count'=>count($foundUsers)]);
		}
    }
}
