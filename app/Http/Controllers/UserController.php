<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __invoke(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        return view('pages.user.index', compact('user'));
    }
}
