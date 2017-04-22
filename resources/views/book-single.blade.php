@extends('layouts/app')

@section('script')
<script>
var post_id = {{ $id }};
$(function(){
    $.getJSON('/api/' + post_id, function(data){
        console.log(data);
        $('#title').html(data.Info.title);
        $('#body').append('ISBN：' + data.Info.isbn + '<br>');
        $('#body').append('作者：' + data.Info.author + '<br>');
        $('#body').append('出版社：' + data.Info.press + '<br>');
        $('#body').append('存放位置：' + data.Info.location + '<br>');
        $('#body').append('擁有者：' + data.Owner[0].name + '<br>');
        $('#body').append('建檔時間：' + data.Info.created_at + '<br>');
    });
});
</script>
@endsection

@section('content')
<h1></h1>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading" id="title">Title</div>

        <div class="panel-body" id="body">

        </div>
    </div>
</div>
@endsection