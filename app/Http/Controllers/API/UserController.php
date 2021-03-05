<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'email' => strtolower(request('email')),
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
        $user = User::where('api_token', '=', $token)->first(); //MENGAMBIL USER YANG SEDANG LOGIN
        return response()->json(['status' => 'success', 'data' => $user,]);
    }

    public function update($token)
    {
        request()->validate([
            'id' => 'required',
            'nama' => 'required',
            'email' =>  ['required', 'string', 'email', 'max:255'],
        ]);

        // Parsing data
        $data = [
            'name' => request('nama'),
            'email' => strtolower(request('email'))
        ];



        $user = User::where('api_token', '=', $token)->first();
        $user->update($data);
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    public function changePassword($token)
    {

        $user = User::where('api_token', '=', $token)->first();

        if (!(Hash::check(request('pass_lama'), $user->password))) {
            // The passwords matches
            return response()->json([
                "status" => "error",
                "message" => "Your current password does not matches with the password you provided. Please try again."
            ]);
        }

        if (strcmp(request('pass_lama'), request('pass_baru')) == 0) {
            //Current password and new password are same
            return response()->json([
                "status" => "error",
                "message" => "New Password cannot be same as your current password. Please choose a different password."
            ]);
        }
        // if(!(strcmp(request('pass_baru'), request('pass_baru-confirm'))) == 0){
        //     //New password and confirm password are not same
        //     return response()->json([
        //         "status" => "error",
        //         "message" => "New Password should be same as your confirmed password. Please retype new password.
        //     "]);
        // }
        //Change Password
        // $user = Auth::user();
        // $user->password = bcrypt(request('pass_baru'));
        // $user->save();
        $pass = bcrypt(request('pass_baru'));

        $user->update([
            'password' => $pass
        ]);

        return response()->json([
            "status" => "success",
            "message" => "Password telah berhasil diubah"
        ]);
    }
}
