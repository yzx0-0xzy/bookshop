@extends('layouts.app')
@section('title', '我的想要的书籍')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">想要的书</div>
        @foreach ($wants as $want)
          <a href="/book/{{$want->book_id}}" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="col-sm-5">
              <div class="">
                <h5 class="mb-1">{{$want->name}}</h5>
              </div>
              <p class="mb-1">{{$want->discription}}</p>
              <small>定价:{{$want->owner_price}}</small>
            </div>
            <div class="thumbnail">
                <img class="cover" src="\img\{{$want->book_image}}" alt="">
            </div>
          </a>
        @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptsAfterJs')
  <script>
  </script>
@endsection
