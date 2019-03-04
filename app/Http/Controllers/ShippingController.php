<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \Request as Req;
class ShippingController extends Controller
{
    public function editExpress()
    {
        $id = Auth::id();
        $data = DB::table('shippings')->where('user_id', $id)->get();
        if($data->isEmpty())
        {
            DB::table('shippings')->insert([
                'user_id' => $id
            ]);
            $data = DB::table('shippings')->where('user_id', $id)->get();
        }
        return view('expressinfo', ['shipping'=>$data->first()]);
    }

    public function updateExpress()
    {
        $id = Auth::id();
        $data = Req::all();
        DB::table('shippings')
                ->where('user_id', $id)
                ->update([
                        'receiver_name' => $data['receiver_name'],
                        'receiver_phone' => $data['receiver_phone'],
                        'receiver_mobile' => $data['receiver_mobile'],
                        'receiver_province' => $data['receiver_province'],
                        'receiver_city' => $data['receiver_city'],
                        'receiver_district' => $data['receiver_district'],
                        'receiver_address' => $data['receiver_address'],
                        'receiver_zip' => $data['receiver_zip']
                         ]);
        return view('message',['message'=>'保存成功']);
    }
}
