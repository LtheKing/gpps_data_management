<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $isExist = User::where('username', $request->username)->get();
        $passwordCorrect = false;

        if (Count($isExist) > 0) {
            $checkPass = Hash::check($request->password, $isExist[0]->password);
            
            if ($checkPass) {
                return redirect()->route('jemaat_index');
            } 
            else 
            {
                return back()->with('Failed', 'Password Incorrect');
            }

        } else {
            return back()->with('Failed', 'username or password doesnt exists');
        }
    }
}
