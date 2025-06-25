<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Hiển thị danh sách người dùng
    public function index()
    {
        $users = User::where('is_admin', false)->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // Xoá người dùng
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->is_admin) {
            return redirect()->back()->with('error', 'Không thể xoá tài khoản admin!');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Đã xoá người dùng thành công!');
    }
}
