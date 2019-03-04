@extends('layouts.app')
@section('title', '编辑书籍信息')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">编辑书籍信息</div>
                @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="\mybooks\{{$book->id}}\edit">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">标题</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="title" required autofocus value="{{$book->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">描述</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="discription" required autofocus value="{{$owner->discription}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">分类</label>
                            <div class="col-md-6">
                            <select name="subcategory" class="form-control input-sm pull-right" id="category">
                                    <option value="">选择分类（默认为未分类）</option>
                                    @foreach ($categorys as $category)
                                    <option value="{{$category->subid}}"> {{$category->cate}}-->{{$category->subcate}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">出版社</label>
                            <div class="col-md-6">
                            <select name="publisher" class="form-control input-sm pull-right" id="publisher">
                                    <option value="">选择出版社（默认为无）</option>
                                    @foreach ($publishers as $publisher)
                                    <option value="{{$publisher->id}}"> {{$publisher->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">作者</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="writer" required autofocus value="{{$book->writer}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">原价（元）</label>
                            <div class="col-md-6">
                                <input id="name" type="number" step="0.01" class="form-control" name="price" required autofocus value="{{$book->price}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">定价（元）</label>
                            <div class="col-md-6">
                                <input id="name" type="number" step="0.01" class="form-control" name="owner_price" required autofocus value="{{$owner->owner_price}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    保存修改
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scriptsAfterJs')
  <script>
$(document).ready(function(){
    document.getElementById("category")[{{$book->subcategory_id}}].selected=true;
    document.getElementById("publisher")[{{$book->publisher_id}}].selected=true;
    });
  </script>
@endsection
