@extends('layouts.app')

@section('script')
<script>

function getQueryParams(qs) {
    qs = qs.split('+').join(' ');

    var params = {},
        tokens,
        re = /[?&]?([^=]+)=([^&]*)/g;

    while (tokens = re.exec(qs)) {
        params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
    }

    return params;
}

var query = getQueryParams(document.location.search);
var page = '';
if( query.page != undefined ){
    page = '?page=' + query.page;
}

$(function(){
    $.getJSON('{{ route("ShowAll") }}' + page, function(resp){
        
        for(var index in resp.data){
            var obj = resp.data[index];
            $('#tbody').append('<tr><td>'
            + obj.isbn 
            + '</td><td><a href="'
            + '/book/'
            + obj.id + '">'
            + obj.title +'</td><td>'
            + obj.author + '</td></tr>');
        }
        
        if(resp.next_page_url == null){
            $('#btn-next').hide();
        }else if(resp.prev_page_url == null){
            $('#btn-pre').hide();
        }
        if(resp.prev_page_url){
            $('#btn-pre').attr('href', resp.prev_page_url.replace('books', '')); 
        }
        $('#btn-next').attr('href', resp.next_page_url.replace('books', ''));
        
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
<br/>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>書名</th>
                                <th>作者</th>
                            </tr>
                        </thead> 
                        <tbody id="tbody">

                        </tbody>
                    </table>
                    <a class="btn btn-primary" id="btn-pre">Previous</a>
                    <a class="btn btn-primary" id="btn-next">Next</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
