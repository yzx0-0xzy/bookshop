@extends('layouts.app')
@section('title', '订单列表')

@section('content')
<div class="row">
<div class="col-lg-10 col-lg-offset-1">
<div class="panel panel-default">
  <div class="panel-heading">订单列表</div>
  <div class="panel-body">
    <div class="product-detail">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#book-buyer-tab" aria-controls="product-detail-tab" role="tab" data-toggle="tab">我买的</a></li>
        <li role="presentation"><a href="#book-seller-tab" aria-controls="product-reviews-tab" role="tab" data-toggle="tab">我卖的</a></li>
      </ul>
      <div class="tab-content" style="border: 1px solid #eee;padding: 20px;">
        <div role="tabpanel" class="tab-pane active" id="book-buyer-tab">
          <!-- 我买的列表开始 -->
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
              <td>卖家</td>
              <td>支付金额</td>
              <td>图书名称</td>
              <td>交易状态</td>
              <td>确认</td>
            </tr>
          </thead>
          @foreach ($buy_orders as $order)
          <tbody>
            <tr>
              <td>{{$order->seller_id}}</td>
              <td>{{$order->book_price}}</td>
              <td>{{$order->book_name}}</td>
              <td>
                @if($order->status === 50)
                      已完成
                    @else
                      未确认
                    @endif
              </td>
              <td>
                    @if($order->status === 50)
                        确认收货成功
                    @else
                        <a type="button" class="btn btn-success" id="confirm_to_{{$order->order_id}}">确认收货</a>
                    @endif
              </td>
            </tr>
          </tbody>
          @endforeach
          </table>
          <!-- 我买的列表结束 -->
        </div>
        <div role="tabpanel" class="tab-pane" id="book-seller-tab">
          <!-- 我卖的列表开始 -->
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <td>买家</td>
              <td>支付金额</td>
              <td>图书名称</td>
              <td>交易状态</td>
            </tr>
          </thead>
          @foreach ($sell_orders as $order)
          <tbody>
            <tr>
              <td>{{$order->buyer_id}}</td>
              <td>{{$order->book_price}}</td>
              <td>{{$order->book_name}}</td>
              <td>
                @if($order->status === 50)
                      已完成
                    @else
                      未确认
                    @endif
              </td>
                
            </tr>
          </tbody>
          @endforeach
          </table>
          <!-- 我卖的列表结束 -->
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
    @foreach ($buy_orders as $order)
    $("#confirm_to_{{$order->order_id}}").click(function(){
      $.get("/update_order", {order_id: "{{$order->order_id}}" },
          function(order_id){
            if(order_id=="-1"){
              alert("错误！您没有权限进行此操作");
              return;
            }
            if(order_id!=""){
              alert("确认收货成功 "+order_id);
              location.reload();
              return;
            }
            alert("未知错误！"+order_id);
          });
    });
    @endforeach
  </script>
@endsection
