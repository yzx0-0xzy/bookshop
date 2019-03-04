@extends('layouts.app')
@section('title', '我的收藏')

@section('content')
<div class="row">
<div class="col-lg-10 col-lg-offset-1">
<div class="panel panel-default">
  <div class="panel-heading">我的收藏</div>
  <div class="panel-body">
    <div class="list-group">
      @foreach($products as $product)
        <div class="col-xs-3 product-item">
          <div class="product-content">
            <div class="top">
              <div class="img">
                <a href="{{ route('book.index', ['book' => $product->id]) }}">
                  <div class="thumbnail">
                    <img class="cover" src="\img\{{$product->book_image}}" alt="">
                  </div>
                </a>
              </div>
              <div class="price"><b>定价:￥</b>{{ $product->price }}</div>
              <a href="{{ route('book.index', ['book' => $product->id]) }}">{{ $product->name }}</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="pull-right">{{ $products->render() }}</div>
  </div>  
</div>
</div>
</div>
@endsection