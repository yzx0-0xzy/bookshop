@extends('layouts.app')
@section('title', '通知')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class='glyphicon glyphicon-exclamation-sign'></span>
                    通知
                </div>
                <div class="panel-body">
                    <h3 class="text-center">{{$message}}</h3>
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
