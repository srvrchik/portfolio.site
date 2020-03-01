<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UsersStore;
use App\Http\Requests\Api\UsersUpdate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function users()
    {
        return User::orderBy('id', 'desc')->get();
    }

    public function user($id)
    {
        return response()->json([
            'user' => User::findOrFail($id)
        ]);
    }

    public function store(UsersStore $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);

        return response()->json([
            'user' => $user
        ]);
    }

    public function update(UsersUpdate $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        return response()->json([
            'user' => $user
        ]);
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:8|max:255|confirmed'
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'password' => Hash::make($request->get('password'))
        ]);

        return response()->json([
            'user' => $user
        ]);
    }

    public function delete($id)
    {
        return response()->json(User::findOrFail($id)->delete());
    }
}
