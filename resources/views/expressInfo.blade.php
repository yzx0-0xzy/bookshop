@extends('layouts.app')
@section('title', '商品列表')

@section('content')
<h1>收货管理</h1>

<form action ="\express" class="form-horizontal" role="form" method="POST">
{{ csrf_field() }}
	<div class="form-group">
			<label for="name" class="col-sm-2 control-label">收货人姓名:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="receiver_name" value="{{$shipping->receiver_name}}"
					placeholder="请输入" required autofocus>
			</div>
	</div>
	<div class="form-group">
			<label for="receiver_phone" class="col-sm-2 control-label">收货人固定电话:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="receiver_phone" value="{{$shipping->receiver_phone}}"
					placeholder="请输入">
			</div>
	</div>
	<div class="form-group">
			<label for="receiver_mobile" class="col-sm-2 control-label">收货人移动电话:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="receiver_mobile" value="{{$shipping->receiver_mobile}}"
					placeholder="请输入" required>
			</div>
	</div>
	<div class="form-group">
			<label for="receiver_province" class="col-sm-2 control-label">省份:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="receiver_province" value="{{$shipping->receiver_province}}"
					placeholder="请输入">
			</div>
	</div>
	<div class="form-group">
			<label for="receiver_city" class="col-sm-2 control-label">城市:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="receiver_city" value="{{$shipping->receiver_city}}"
					placeholder="请输入">
			</div>
	</div>
	<div class="form-group">
			<label for="receiver_district" class="col-sm-2 control-label">区:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="receiver_district" value="{{$shipping->receiver_district}}"
					placeholder="请输入">
			</div>
	</div>
	<div class="form-group">
			<label for="receiver_address" class="col-sm-2 control-label">详细地址:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="receiver_address" value="{{$shipping->receiver_address}}"
					placeholder="请输入">
			</div>
	</div>
	<div class="form-group">
			<label for="receiver_zip" class="col-sm-2 control-label">邮编:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="receiver_zip" value="{{$shipping->receiver_zip}}"
					placeholder="请输入">
			</div>
	</div>
	<div class="col-sm-offset-2 col-sm-10">
		<button type="submit" class="btn btn-default">保存</button>
	</div>
</form>
@endsection

@section('scriptsAfterJs')
  <script>

  </script>
@endsection
