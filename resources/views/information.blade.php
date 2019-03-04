@extends('layouts.app')
@section('title', '商品列表')

@section('content')
<h1>我的信息</h1>

<form action ="\info" class="form-horizontal" role="form" method="POST">
	{{ csrf_field() }}
	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">姓名:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="name" value="{{$user->name}}"
				   placeholder="请输入" required autofocus>
		</div>
	</div>
	<div class="form-group">
		<label for="mobile" class="col-sm-2 control-label">手机:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="mobile" value="{{$user->mobile}}"
				   placeholder="请输入" required>
		</div>
	</div>
	<div class="form-group">
		<label for="gender" class="col-sm-2 control-label">性别:</label>
			<div class="col-sm-10">
				<select class="form-control" id="gender" name="gender"> 
				<option value="0">女</option>
				<option value="1">男</option>
				</select>
			</div>
	</div>

	<div class="form-group">
		<label for="school" class="col-sm-2 control-label">学校:</label>
			<div class="col-sm-10">
			<select class="form-control" id="school" name="school_id">
			@foreach($schools as $school)
				<option value="{{$loop->index + 1}}">{{$school->province}}-->{{$school->city}}-->{{$school->school_name}}</option>
			@endforeach
			</select>
			</div>
	</div>

	<div class="col-sm-offset-2 col-sm-10">
		<button type="submit" class="btn btn-default">保存</button>
	</div>
</form>

@endsection

@section('scriptsAfterJs')
  <script>
	$(document).ready(function(){
		document.getElementById("gender")[{{$user->gender}}].selected=true;
		document.getElementById("school")[{{$user->school_id}}-1].selected=true;
});
  </script>
@endsection
