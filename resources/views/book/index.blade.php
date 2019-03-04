@extends('layouts.app')
@section('title', $product->name)

@section('content')
<div class="row">
<div class="col-lg-10 col-lg-offset-1">
<div class="panel panel-default">
  <div class="panel-body product-info">
    <div class="row">
      <div class="col-sm-5">
      <div class="thumbnail">
        <img class="cover" src="\img\{{$product->book_image}}" alt="">
      </div>
      </div>
      <div class="col-sm-7">
        <div class="title">{{ $product->name }}</div>
        <span style="color:red;font-size:18px;">￥{{$product->owner_price}}</span>
        <span class="text-muted" style="text-decoration:line-through;margin-left:5px">￥{{$product->price}}</span>
        <div class="writer">作者: {{$product->writer}}</div>
        <div class="cart_amount"><label>当前有</label>{{$favoriteNum}}<label>人收藏；有</label>{{$wants}}<label>人想要</label></span><span class="stock"></span></div>

      </div>

      <div class="buttons">
        @if($favored)
          <button class="btn btn-danger btn-disfavor">取消收藏</button>
        @else
          <button class="btn btn-success btn-favor">❤ 收藏</button>
        @endif
        @if($wanted)
          <button class="btn btn-danger btn-remove-from-cart">撤销想要</button>
        @else
          <button class="btn btn-primary btn-add-to-cart">我想要</button>
        @endif
      </div>
    </div>
    <div class="product-detail">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#product-detail-tab" aria-controls="product-detail-tab" role="tab" data-toggle="tab">书本详情</a></li>
        <li role="presentation"><a href="#product-reviews-tab" aria-controls="product-reviews-tab" role="tab" data-toggle="tab">书本留言</a></li>
        <li role="presentation"><a href="#seller-detail-tab" aria-controls="seller-detail-tab" role="tab" data-toggle="tab">卖家信息</a></li>
      </ul>

      <div class="tab-content" style="border: 1px solid #eee;padding: 20px;">
        <div role="tabpanel" class="tab-pane active" id="product-detail-tab">
          {{$product->discription}}
        </div>
        <div role="tabpanel" class="tab-pane" id="product-reviews-tab">
          <!-- 评论列表开始 -->
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <td>用户</td>
              <td>留言</td>
              <td>时间</td>
              </tr>
            </thead>
            @foreach ($comments as $comment)
            <tbody>
              <tr>
                <td>{{$comment->name}}</td>
                  <td>{{$comment->content}}</td>
                  <td>{{$comment->created_at}}</td>
              </tr>
            </tbody>
            @endforeach
            <form class="form-horizontal" method="POST" action="\message" enctype="multipart/form-data">
              {{ csrf_field() }}
            <tbody>
              <tr>
                <td><input type="hidden" id="book_id" type="text" class="form-control" name="book_id" value="{{$product->id}}">{{$name}}</td>
                  <td><input id="content" type="text" class="form-control" name="content"></td>
                  <td>
                  <button class="btn btn-success btn-message">
                    留言
                  </button>
                  </td>
              </tr>
            </tbody>
            </form>
          </table>
          <!-- 评论列表结束 -->
        </div>
        <div role="tabpanel" class="tab-pane" id="seller-detail-tab">
          <table class="table table-bordered table-striped">
            <tbody>
              <tr>
                <td>学校</td>
                <td>华南理工大学</td>
              </tr>
              <tr>
                <td>姓名</td>
                <td>{{$seller->name}}</td>
              </tr>
              <tr>
                <td>性别</td>
                <td>{{$seller->gender}}</td>
              </tr>
              <tr>
                <td>联系方式1</td>
                <td>{{$seller->mobile}}</td>
              </tr>
              <tr>
                <td>联系方式2</td>
                <td>{{$seller->contact_backup}}</td>
              </tr> 
            </tbody>
          </table>
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
  $(document).ready(function () {

    $('.btn-favor').click(function () {
      axios.post('{{ route('book.disfavor', ['book' => $product->book_id]) }}')
        .then(function () {
          //swal('操作成功', '', 'success')
          //.then(function () {  // 这里加了一个 then() 方法
              location.reload();
            //});
        }, function(error) {
          if (error.response && error.response.status === 401) {
            alert('请先登录');
          } else if (error.response && error.response.data.msg) {
            alert('error');
          } else {
            alert('系统错误');
          }
        });
    });

    $('.btn-disfavor').click(function () {
      axios.delete('{{ route('book.disfavor', ['book' => $product->book_id]) }}')
        .then(function () {
          //swal('操作成功', '', 'success')
            //.then(function () {
              location.reload();
            //});
        });
    });

    $('.btn-add-to-cart').click(function () {
      axios.post('{{ route('book.want', ['book' => $product->book_id]) }}')
        .then(function () {
          //swal('操作成功', '', 'success')
          //.then(function () {  // 这里加了一个 then() 方法
              location.reload();
          // });
        }, function(error) {
          if (error.response && error.response.status === 401) {
            alert('请先登录');
          } else if (error.response && error.response.data.msg) {
            alert('error');
          } else {
            alert('系统错误');
          }
        });
    });

    $('.btn-remove-from-cart').click(function () {
      axios.delete('{{ route('book.diswant', ['book' => $product->book_id]) }}')
        .then(function () {
          //swal('操作成功', '', 'success')
          //  .then(function () {
              location.reload();
          //  });
        });
    });

    function do_submit() {
      location.reload();
    }

  });
</script>
@endsection
