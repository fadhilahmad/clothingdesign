<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// bring in user model
use App\User;
use Gate;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // set limit to view on page to different type of users
        if(!Gate::allows('isCustomer')){
            abort(404, "Sorry, you cannot do this action");
        }

        // get the user id
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('dashboard')->with('posts', $user->posts);
    }
}
