@extends('layouts.app')
@section('title', '二手学长网')

@section('content')
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
    <form action="/" class="form-inline search-form" method="post">
        {{ csrf_field() }}
        
        <input type="text" class="form-control input-lg search_input" name="search" placeholder="搜索" value="{{$search}}" >
        
        <div class="btn-group btn-group-lg">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            分类
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu dropdown-menu-right">
            @foreach ($categorys as $category)
            <li><a id="cat{{$category->id}}">{{$category->name}}</a></li>
            @endforeach
          </ul>
        </div>
        <button class="btn btn-primary btn-lg" >搜索</button>
        <select name="order" class="form-control input-lg pull-right sort_select" >
          <option value="arbitary">排序方式</option>
          <option value="price_asc">价格从低到高</option>
          <option value="price_desc">价格从高到低</option>
          <option value="current_school">只看校友发布的书</option>
        </select>
      </form>
    </div>
    <div class="row products-list">
        
    </div>
  </div>
</div>
</div>
</div>

@if(count($boo)===0)
<div class="row" id="books-view">
<div class="col-sm-6 col-md-3">
    <h2 style="margin-left:10px">没有找到结果!</h2>
</div>
</div>
@else
<div class="row" id="books-view">
@foreach ($boo as $book)
    <div class="col-sm-6 col-md-3">
         <div class="thumbnail">
           <img src="\img\{{ $book->book_image }}" />
            <div class="caption">
                <a href="\book\{{$book->id}}">
                <h4 >{{$book->name}}</h4>
                </a>
                <p>
                  <span style="color:red;font-size:18px">￥{{$book->owner_price}}</span>
                  <span class="text-muted" style="text-decoration:line-through;margin-left:5px">￥{{$book->price}}</span>
                </p>
            </div>
         </div>
    </div>
@endforeach
</div>
@if($pagi===1)
{{ $boo->links() }}
@endif
@endif



@endsection



@section('scriptsAfterJs')
  <script>
    @foreach ($categorys as $category)
    $("#cat{{$category->id}}").on("click", function(){
      $.get("/filter", { cat: "{{$category->id}}"},
          function(data){
            var obj = JSON.parse(data);
            $("#books-view").empty();
            for(var i=0;i<obj.length;i++)
            {
              var data='<div class=\"col-sm-6 col-md-3\"><div class=\"thumbnail\"><img src=\"\\img\\'+
              obj[i].book_image+
              '\" /><div class=\"caption\"><a href=\"\\book\\'+
              obj[i].id+
              '\"><h4 >'+
              obj[i].name+
              '</h4></a><p><span style=\"color:red;font-size:18px\">￥'+
              obj[i].owner_price+
              '</span><span class=\"text-muted\" style=\"text-decoration:line-through;margin-left:5px\">￥'+
              obj[i].price+
              '</span></p></div></div></div>';
              console.log(data);
              $("#books-view").append(data);
            }
            $(".pagination").hide()
          });
    });
    @endforeach
  </script>
@endsection
