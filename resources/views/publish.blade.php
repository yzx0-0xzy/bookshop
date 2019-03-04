@extends('layouts.app')
@section('title', '发布旧书')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">发布旧书</div>
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
                    <form class="form-horizontal" method="POST" action="\publish" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">标题</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="title" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">描述</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="discription" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">分类</label>
                            <div class="col-md-6">
                            <select name="subcategory" class="form-control input-sm pull-right">
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
                            <select name="publisher" class="form-control input-sm pull-right">
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
                                <input id="name" type="text" class="form-control" name="writer" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">图片</label>
                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control" name="image" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">原价（元）</label>
                            <div class="col-md-6">
                                <input id="name" type="number" step="0.01" class="form-control" name="price" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">定价（元）</label>
                            <div class="col-md-6">
                                <input id="name" type="number" step="0.01" class="form-control" name="owner_price" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    发布
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
  </script>
@endsection
