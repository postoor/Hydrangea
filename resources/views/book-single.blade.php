@extends('layouts/app')

@section('script')
<script>
var post_id = {{ $id }};
$(function(){
    $.getJSON('/books/' + post_id, function(data){
        console.log(data);
        $('#title').html(data.Info.title);
        $('#body').append('<div style="float:left"><img class="cover" src="http://im2.book.com.tw/image/getImage?i=http://www.books.com.tw/img/001/049/50/0010495069.jpg&v=4d3034e3&w=348&h=348"><div>');
        $('#body').append('<dl><dd>ISBN：' + data.Info.isbn + '</dd>');
        $('#body').append('<dd>作者：' + data.Info.author + '</dd>');
        $('#body').append('<dd>出版社：' + data.Info.press + '</dd>');
        $('#body').append('<dd>存放位置：' + data.Info.location + '</dd>');
        $('#body').append('<dd>擁有者：' + data.Owner[0].name + '</dd>');
        $('#body').append('<dd>建檔時間：' + data.Info.created_at + '</dd></dl>');
    });
});
</script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form method="POST" action="{{ route('searchISBN') }}">
                {{ csrf_field() }}
                               
                    <div class="input-group btn-group">
                        <input id="isbn-search" type="text" class="form-control" name="isbn" placeholder="請輸入ISBN">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary" >
                                Search
                            </button>
                        </span>
                    </div>
            </form>
        </div>
    </div>
</div>

<h1></h1>
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading" id="title">Title</div>

            <div class="panel-body" id="body" >

            </div>
        </div>
    </div>
</div>
@endsection