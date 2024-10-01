<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data User',
            'data_user' => User::all(),
        );

        return view('admin.master.user.list',$data);
    }

    public function store(Request $request)
{
    // Validasi input form
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:4',
        'role' => 'required|string',
    ]);

    // Jika validasi lolos, buat user baru
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    return redirect()->route('admin.user')->with('success', 'Data Berhasil Disimpan');
}

    public function update(Request $request,$id){
        User::where('id',$id)
            ->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        
        return redirect()->route('admin.user')->with('success', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $user = User::Where('id',$id)->delete();
        return redirect()->route('admin.user')->with('success', 'Data Berhasil Dihapus');
    }
}
