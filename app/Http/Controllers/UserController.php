<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \Request as Req;
class UserController extends Controller
{
    public function editInfo()
    {
        $id = Auth::id();
        $userinfo = DB::table('users')->where('id', $id)->get();
        $schoolList = DB::table('schools')->get();
        //return $schoolList->first();
        return view('information', ['user'=>$userinfo[0], 'schools'=>$schoolList]);
    }

    public function updateInfo()
    {
        $id = Auth::id();
        $data = Req::all();
        DB::table('users')
                ->where('id', $id)
                ->update([
                        'name' => $data['name'],
                        'mobile' => $data['mobile'],
                        'gender' => $data['gender'],
                        'school_id' => $data['school_id'],
                         ]);
        return view('message',['message'=>'保存成功']);
    }
}
