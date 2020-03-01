<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function user(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }

    public function changeTheme(Request $request)
    {
        $user = $request->user();

        if($user->admin_theme)
            $user->admin_theme = 0;
        else
            $user->admin_theme = 1;

        $user->save();
        return response()->json([
            'theme' => $user->admin_theme
        ]);
    }
}
