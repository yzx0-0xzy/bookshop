<?php

namespace App\Http\Controllers;

use App\Book;
use App\user;
use App\Want as Wants;
use App\Comment as Comments;
use App\Owner as Owners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Request as Req;
use Redirect;

class BookDetailController extends Controller
{
    //
    public function index(Book $book, Request $request)
    {
    	if($user = $request->user()) {
    		$myselfBooks = Owners::query()->where('book_id', $book->id)->where('owner_id', $user->id)->get();
            if (!$myselfBooks->isEmpty()){
            	return redirect()->route('mybooks', [$book->id]);
            }
            $favored = boolval($user->favoriteProducts()->find($book->id));
            $wanted = Wants::query()->where('user_id', $user->id)->where('book_id', $book->id)->get();
            $hasWanted = true;
            if ($wanted->isEmpty()){
            	$hasWanted = false;
            }
        }
    	$books = DB::select('select * from owners left join books on owners.book_id=books.id where book_id = ?', [$book->id]);
    	$favorite = DB::select('select * from favorite_books where book_id = ?', [$book->id]);
    	$favoriteNum = count($favorite);
    	$wants = DB::select('select * from wants where book_id = ?', [$book->id]);
    	$wantsNum = count($wants);
    	$comments = DB::select('select book_id,user_id,comments.status,content,comments.created_at,
        name,email,school_id,gender,is_admin from comments left join users on comments.user_id=users.id where book_id = ?', [$book->id]);
        $sellerId = Owners::query()->where('book_id', $book->id)->first();
        $seller = User::query()->where('id', $sellerId->owner_id)->first();
        return view('book.index', ['product' => $books[0], 'wants' => $wantsNum, 
        'favoriteNum' => $favoriteNum, 'comments' => $comments, 'favored' => $favored, 
        'wanted' => $hasWanted, 'name' => $user->name, 'seller' => $seller]);
    }
    //收藏
    public function favor(Book $book, Request $request)
    {
        $user = $request->user();
        if ($user->favoriteProducts()->find($book->id)) {
            return [];
        }

        $user->favoriteProducts()->attach($book);

        return [];
    }
    //取消收藏入口
    public function disfavor(Book $book, Request $request)
    {
        $user = $request->user();
        $user->favoriteProducts()->detach($book);

        return [];
    }
    //查看收藏夹
    public function favorites(Request $request)
    {
        $products = $request->user()->favoriteProducts()->paginate(5);
        if(count($products)==0)return view('message',['message'=>'没有找到您的收藏']);
        return view('book.favorites', ['products' => $products]);
    }
    //我想要
    public function want(Book $book, Request $request)
    {

    	$user = $request->user();
    	$wants = new Wants();
    	$wants->user_id = $user->id;
    	$wants->book_id = $book->id;
    	$wants->save();
        
        return [];
    }
    //我不要了
    public function diswant(Book $book, Request $request)
    {

    	$user = $request->user();
    	Wants::query()->where('user_id', $user->id)->where('book_id', $book->id)->delete();
        
        return [];
    }

    //留言
    public function message(Request $request)
    {
    	$input=Req::all();
    	$user = $request->user();
    	$comments = new Comments();
    	$comments->user_id = $user->id;
    	$comments->book_id = $input['book_id'];
    	$comments->status = 0;
    	$comments->content = $input['content'];
    	$comments->save();
        
        return Redirect::back();
    }

}
