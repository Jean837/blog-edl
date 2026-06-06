<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::where('role', '!=', 'admin')
                     ->orderBy('created_at', 'desc')
                     ->get();
        return view('admin.users.index', compact('users'));
    }

    public function promote(User $user) {
        if ($user->role === 'user') {
            $user->update(['role' => 'named_admin']);
            return back()->with('success', '✅ ' . $user->name . ' est maintenant administrateur nommé !');
        }
        return back()->with('error', 'Impossible de promouvoir cet utilisateur.');
    }

    public function demote(User $user) {
        if ($user->role === 'named_admin') {
            $user->update(['role' => 'user']);
            return back()->with('success', '✅ ' . $user->name . ' est redevenu utilisateur.');
        }
        return back()->with('error', 'Impossible de rétrograder cet utilisateur.');
    }
}