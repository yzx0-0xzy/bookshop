<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Request as Req;
use \Input as Input;


class BookController extends Controller
{
    //mybooks 界面
    public function getAllBooksByOwner(){
        $id = Auth::id();
        // $books = DB::select('select * from owners left join books on owners.book_id=books.id where owner_id = ?', [$id]);
        
        $books=DB::select('select t6.book_id,count(comments.user_id) comment_count,t6.created_at,discription,owner_price,name from comments right join 
        (select book_id,owner_id,name,books.created_at,discription,owner_price from owners left join books on owners.book_id=books.id where owner_id = ?)
         as t6 on comments.book_id=t6.book_id group by t6.book_id,t6.created_at,discription,owner_price,name
        ',[$id]);
        if(count($books)==0)return view('message',['message'=>'没有找到您发布的书']);
        return view('mybooks.index',['books' => $books]);
    }
    
    //得到对应bookid的mybook界面(仅书的主人可以看到)
    public function getBookByOwner(Book $book){
        $id = Auth::id();
        $owner = DB::select('select * from owners where book_id = ?', [$book->id]);
        if($id!=$owner[0]->owner_id) return view('message',['message' => "您没有权限访问此界面"]);
        
        $wants = DB::select('select name,wants.user_id,email,wants.created_at from wants 
        left join users on wants.user_id=users.id where book_id = ?', [$book->id]);
        
        $comments = DB::select('select book_id,user_id,comments.status,content,comments.created_at,
        name,email,school_id,gender,is_admin from comments left join users on comments.user_id=users.id where book_id = ?', [$book->id]);
        
        return view('mybooks.show',['owner' => $owner[0],'book' => $book,'comments' => $comments,'wants' => $wants]);
    }

    //编辑对应id的书籍
    public function editBookByOwner(Book $book){
        $id = Auth::id();
        $owner = DB::select('select * from owners where book_id = ?', [$book->id]);
        if($id!=$owner[0]->owner_id) return view('message',['message' => "您没有权限编辑此书"]);
        $categorys = DB::select('select subcategorys.name subcate,categorys.name cate,categorys.id id,subcategorys.id subid from subcategorys join categorys on categorys.id=subcategorys.category_id order by subid');
        $publishers = DB::select('select * from publishers order by id');
        return view('mybooks.edit',['owner' => $owner[0],'book' => $book,'categorys' => $categorys,'publishers'=>$publishers]);
    }
    //保存修改
    public function updateBookByOwner(Book $book){
        $input=Req::all();
        $id = Auth::id();
        $owner = DB::select('select * from owners where book_id = ?', [$book->id]);
        if($id!=$owner[0]->owner_id) return view('message',['message' => "您没有权限编辑此书"]);

        DB::table('books')->where('id', $book->id)
            ->update(
            [
                'name' => $input['title'], 
                'publisher_id' => $input['publisher'],
                'subcategory_id' => $input['subcategory'],
                'writer' => $input['writer'],
                'price' => $input['price'],
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                ]);
        DB::table('owners')->where('book_id',$book->id)->update([
            'owner_price'=>$input['owner_price'],
            'discription'=>$input['discription'],
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        return redirect('/mybooks');
    }
    //删除对应id的书籍
    public function deleteBookByOwner(Book $book){
        $id = Auth::id();
        $owner = DB::select('select * from owners where book_id = ?', [$book->id]);
        if($id!=$owner[0]->owner_id) return view('message',['message' => "您没有权限删除此书"]);
        DB::table('books')->where('id', '=', $book->id)->delete();
        DB::table('owners')->where('book_id', '=', $book->id)->delete();
        DB::table('wants')->where('book_id', '=', $book->id)->delete();
        DB::table('comments')->where('book_id', '=', $book->id)->delete();
        return view('message',['message' => '删除成功']);
    }

    //发布旧书
    public function getPublishView(){
        $categorys = DB::select('select subcategorys.name subcate,categorys.name cate,categorys.id id,subcategorys.id subid from subcategorys join categorys on categorys.id=subcategorys.category_id order by subid');
        $publishers = DB::select('select * from publishers order by id');

        return view('publish',['categorys' => $categorys,'publishers'=>$publishers]);
    }
    //保存发布的书籍
    public function store(Request $request){
        $id=Auth::id();
        $input=Req::all();
        $this->validate($request,[
            'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $imagefile=$request->file('image');
        $photoName = $id.'-'.time().'.'.$imagefile->getClientOriginalExtension();
        $request->image->move(getcwd().'\/img/', $photoName);
        $bookid = DB::table('books')->insertGetId(
            [
                'name' => $input['title'], 
                'publisher_id' => $input['publisher'],
                'subcategory_id' => $input['subcategory'],
                'writer' => $input['writer'],
                'price' => $input['price'],
                'book_image' => $photoName,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                ]);
        if($bookid==null) return view('message',['message' => "发生错误，发布失败"]);
        else DB::table('owners')->insert([
            'book_id'=>$bookid,
            'owner_price'=>$input['owner_price'],
            'discription'=>$input['discription'],
            'owner_id'=>$id,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        return view('message',['message' => "发布成功"]);
    }
    
    public function getALlWants(){
        $id = Auth::id();
        $wants = DB::select("select * from wants join (books join owners on books.id=owners.book_id) on wants.book_id=books.id where wants.user_id=?",[$id]);
        if(count($wants)==0)return view('message',['message'=>'没有找到您想要的书']);
        return view('wants',['wants'=>$wants]);
    }
}
