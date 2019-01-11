<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {

        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            $users = Profile::where('name', $cond_title)->get();
        } else if (Auth::user()->id != 9) {
            return redirect('users/news/');
        } else {
            $users = Profile::all()->sortByDesc('created_at');
        }

        return view('admin.index', ['users' => $users, 'cond_title' => $cond_title]);
    }

}
