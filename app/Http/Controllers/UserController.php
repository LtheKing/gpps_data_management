<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;

class UserController extends Controller
{
    public function login(Request $request)
    {
        session([
            'cabang_id' => $request->cabang_id,
            'username' => $request->username,
        ]);

        $isExist = DB::table('users')
            ->where('username', $request->username)
            ->where('cabang_id', $request->cabang_id)
            ->get();
        $passwordCorrect = false;

        // dd($isExist);

        if (Count($isExist) > 0) {
            $checkPass = Hash::check($request->password, $isExist[0]->password);
            // dd($checkPass);
            if ($checkPass) {
                return redirect()->route('jemaat_index');
            } else {
                return back()->with('Failed', 'Password Incorrect');
            }

        } else {
            return back()->with('Failed', 'username or password doesnt exists');
        }
    }

    public function getSession()
    {
        session([
            'cabang' => 'bandung',
        ]);
        return (Session::all());
    }
}
