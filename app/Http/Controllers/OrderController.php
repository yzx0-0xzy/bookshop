<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Request as Req;
use App\Order;

class OrderController extends Controller
{
    //创建订单
    public function createOrder(Request $request)
    {
        $my_id = Auth::id();
        $owner = DB::select('select * from owners where book_id = ?', [$request->book_id]);
        if($my_id!=$owner[0]->owner_id) return -1;//没有权限完成此操作
        // return -1;
        $books=DB::select('select * from books where id=?',[$request->book_id]);
        $book=$books[0];
        $order_id = DB::table('orders')->insertGetId([
            'buyer_id'=>$request->user_id,
            'seller_id'=>$my_id,
            'status'=> 30,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        DB::table('order_items')->insert([
            'order_id'=>$order_id,
            'buyer_id'=>$request->user_id,
            'seller_id'=>$my_id,
            'book_id'=>$book->id,
            'book_name'=>$book->name,
            'book_image'=>$book->book_image,
            'book_price'=>$owner[0]->owner_price,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('books')->where('id', '=', $book->id)->delete();
        DB::table('owners')->where('book_id', '=', $book->id)->delete();
        DB::table('wants')->where('book_id', '=', $book->id)->delete();
        DB::table('comments')->where('book_id', '=', $book->id)->delete();
        return $order_id;
    }
    public function index(Request $request)
    {
        $buy_orders = DB::table('orders')
            ->join('order_items','orders.id','=','order_items.order_id')
            ->where('orders.buyer_id', $request->user()->id)
            ->get();
        $sell_orders = DB::table('orders')
            ->join('order_items','orders.id','=','order_items.order_id')
            ->where('orders.seller_id', $request->user()->id)
            ->paginate();
        return view('orders.index', ['buy_orders' => $buy_orders,'sell_orders' => $sell_orders]);
    }
    public function update(Request $request)
    {
        $my_id = Auth::id();
        $owner = DB::select('select * from orders where id = ?', [$request->order_id]);
        if($my_id!=$owner[0]->buyer_id) return -1;//没有买家权限完成此操作
        $order_id=Order::where('id',$request->order_id)
                        ->update(['status'=> 50]);
        return $order_id;
    }
}
