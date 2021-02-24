<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', '0')->orderBy('created_at', 'DESC');
        if (request()->q != '') {
            $users =  $users->where('email', 'LIKE', '%' . request()->q . '%')
                ->orWhere('name', 'LIKE', '%' . request()->q . '%');
        }
        return new UserCollection($users->paginate(10));
    }

    public function store()
    {
        // Form Validasi
        request()->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'divisi' => 'required',
            // 'gambar' => 'image'
        ]);


        // Insert into database
        $aset = User::create([
            'name' => request('nama'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'divisi' => request('divisi'),
            'email_verified_at' => now(),
        ]);

        // Return pesan sukses
        return response()->json([
            'message' => 'Akun telah berhasil didaftarkan',
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['status' => 'success', 'user' => $user], 200);
    }

    public function getUserLogin($token)
    {
        $user = User::where('api_token','=',$token)->first(); //MENGAMBIL USER YANG SEDANG LOGIN
        return response()->json(['status' => 'success', 'data' => $user,]);
    }
}
