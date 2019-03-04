<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request as Req;
use App\Http\Requests;
use Request;
use App\user;
use Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books=DB::table('books')
        ->join('owners', 'books.id', '=', 'owners.book_id')
        ->select('books.*', 'owners.owner_price')
        ->paginate(12);
        $categorys =DB::select('select * from categorys');
        return view('index',['boo' => $books,'search'=>'','categorys'=>$categorys,'pagi'=>1]);
    }
    public function search()
    {
        $input=Request::all();
        $id = Auth::id();

        if($input['order']==='arbitary')
        {
            
            $books=DB::table('books')
            ->join('owners', 'books.id', '=', 'owners.book_id')
            ->select('books.*', 'owners.owner_price')
            ->where('name',$input['search'])
            ->get();
            
            
        }else if($input['order']==='price_asc'){

            $books=DB::table('books')
            ->join('owners', 'books.id', '=', 'owners.book_id')
            ->select('books.*', 'owners.owner_price')
            ->where('name',$input['search'])
            ->orderBy('owners.owner_price', 'asc')
            ->get();
            
        }else if($input['order']==='price_desc')
        {
            $books = DB::table('books')->where('name',$input['search'])->orderBy('price', 'asc')->get();
            $books=DB::table('books')
            ->join('owners', 'books.id', '=', 'owners.book_id')
            ->select('books.*', 'owners.owner_price')
            ->where('name',$input['search'])
            ->orderBy('owners.owner_price', 'desc')
            ->get();
            
        }else if($input['order']==="current_school")
        {
            
            $school_id = DB::table('users')->where('id', $id)->value('school_id');
            $books=DB::table('users')
            ->join('owners','users.id','=','owners.owner_id')
            ->join('books','owners.book_id','=','books.id')
            ->select('books.*', 'owners.owner_price')
            ->where('books.name',$input['search'])
            ->where('users.school_id',$school_id)
            ->where('users.id','<>',$id)
            ->get();
        }
        $categorys =DB::select('select * from categorys');
        return view('index',['boo' => $books,'search'=>$input['search'],'categorys'=>$categorys,'pagi'=>0]);
    }
    public function catFilter(Req $request){
        //$cate = DB::("select * from categorys where id=?",[$request->cat]);
        $cate=DB::table('categorys')
        ->join('subcategorys','categorys.id','=','subcategorys.category_id')
        ->join('books','books.subcategory_id','=','subcategorys.id')
        ->join('owners','books.id','=','owners.book_id')
        ->select('books.*', 'owners.owner_price')
        ->where('categorys.id',[$request->cat])
        ->get();
        return json_encode($cate);
    }
    public function emailVerifyNotice(Request $request)
    {
        $id = Auth::id();
        $user = User::query()->where('id', $id)->first();
        if (!$user->email_verified){
            return view('pages.email_verify_notice');
        }
        else return Redirect::to('/');
    }
}
