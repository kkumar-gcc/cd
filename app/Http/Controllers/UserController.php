<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('access users'))
        {
            abort(404);
        }
        return view('users.index');
    }
}
