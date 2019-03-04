@extends('layouts.app')
@section('title', '我发布的书籍')

@section('content')
<div class="row">
<div class="col-lg-10 col-lg-offset-1">
<div class="panel panel-default">
  <div class="panel-body product-info">
    <div class="row">
      <div class="col-sm-5">
      <div class="thumbnail">
        <img class="cover" src="\img\{{$book->book_image}}" alt="">
      </div>
      </div>
      <div class="col-sm-7">
        <div class="title"style="font-size:30px">{{$book->name}}</div>
        <span style="color:red;font-size:18px;">￥{{$owner->owner_price}}</span>
        <span class="text-muted" style="text-decoration:line-through;margin-left:5px">￥{{$book->price}}</span>
        <div class="writer">作者: {{$book->writer}}</div>
      </div>
      <div class="btn-group" role="group" aria-label="..." style="padding: 10px;">
        <a href="/mybooks/{{$book->id}}/edit">
          <button type="button" class="btn btn-default">编辑书籍</button>
        </a>
        <a href="/mybooks/{{$book->id}}/delete">
          <button type="button" class="btn btn-danger">删除书籍</button>
        </a>
      </div>
    </div>
    <div class="product-detail">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#product-detail-tab" aria-controls="product-detail-tab" role="tab" data-toggle="tab">我的描述</a></li>
        <li role="presentation"><a href="#product-reviews-tab" aria-controls="product-reviews-tab" role="tab" data-toggle="tab">查看留言</a></li>
        <li role="presentation"><a href="#product-wants-tab" aria-controls="product-wants-tab" role="tab" data-toggle="tab">想要本书的人</a></li>
      </ul>
      <div class="tab-content" style="border: 1px solid #eee;padding: 20px;">
        <div role="tabpanel" class="tab-pane active" id="product-detail-tab">
          {{$owner->discription}}
        </div>
        <div role="tabpanel" class="tab-pane" id="product-reviews-tab">
          <!-- 评论列表开始 -->
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <td>用户</td>
              <td>留言</td>
              <td>email</td>
              <td>时间</td>
            </tr>
          </thead>
          @foreach ($comments as $comment)
          <tbody>
            <tr>
              <td>{{$comment->name}}</td>
                <td>{{$comment->content}}</td>
                <td>{{$comment->email}}</td>
                <td>{{$comment->created_at}}</td>
            </tr>
          </tbody>
          @endforeach
          </table>
          <!-- 评论列表结束 -->
        </div>
        <div role="tabpanel" class="tab-pane" id="product-wants-tab">
          <!-- 想要列表开始 -->
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <td>用户</td>
              <td>email</td>
              <td>时间</td>
              <td>操作</td>
            </tr>
          </thead>
          @foreach ($wants as $want)
          <tbody>
            <tr>
                <td>{{$want->name}}</td>
                <td>{{$want->email}}</td>
                <td>{{$want->created_at}}</td>
                <td>
                  <a type="button" class="btn btn-success" id="sell_to_{{$want->user_id}}">卖给他</a> 
                </td>
            </tr>
          </tbody>
          @endforeach
          </table>
          <!-- 想要列表结束 -->
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection

@section('scriptsAfterJs')
  <script>
    @foreach ($wants as $want)
    $("#sell_to_{{$want->user_id}}").click(function(){
      $.get("/sell_book", { user_id: "{{$want->user_id}}",book_id:"{{$book->id}}" },
          function(order_id){
            if(order_id=="-1"){
              alert("错误！您没有权限进行此操作");
              return;
            }
            if(order_id!=""){
              alert("操作成功！订单号为："+order_id)
              window.location.replace("/order");
              return;
            }
            alert("未知错误！");
          });
    });
    @endforeach
  </script>
@endsection
