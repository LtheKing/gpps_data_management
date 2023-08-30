<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Yonatan;

class YonatanController extends Controller
{
    public function create(Request $request){
        Yonatan::create($request->all());
        return response('Data Created Successfully', 200);
    }
}
