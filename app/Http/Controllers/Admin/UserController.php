<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index');
    }

    public function getData()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        if (request('keywords')) {
            $users = User::where('username', 'LIKE', '%' . request('keywords') . '%')->orWhere('email', 'LIKE', '%' . request('keywords') . '%')->paginate(10);
        }
        return response()->json($users, 200);
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        $user->role()->detach();
        return response()->json(null, 200);
    }
}
