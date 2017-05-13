@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form method="POST" action="{{ route('auto') }}">
                {{ csrf_field() }}
                               
                    <div class="input-group btn-group">
                        <input id="name" type="text" class="form-control" name="isbn" placeholder="請輸入ISBN">
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
            
                <div class="panel-heading">User List</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('store') }}">
                        {{ csrf_field() }}
                        <div>
                            <label for="isbn" class="col-md-4 control-label">ISBN</label>
                            <div class="col-md-6">
                                <input id="isbn" type="text" class="form-control" name="isbn" value="{{ $isbn or '' }}" >
                            </div>
                        </div>

                        <div>
                            <label for="title" class="col-md-4 control-label">Title</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $title or '' }}" >
                            </div>
                        </div>

                        <div>
                            <label for="author" class="col-md-4 control-label">Author</label>
                            <div class="col-md-6">
                                <input id="author" type="text" class="form-control" name="author" value="{{ $author or '' }}" >
                            </div>
                        </div>

                        <div>
                            <label for="press" class="col-md-4 control-label">Press</label>
                            <div class="col-md-6">
                                <input id="press" type="text" class="form-control" name="press" value="{{ $press or '' }}" >
                            </div>
                        </div>

                        <div>
                            <label for="location" class="col-md-4 control-label">Location</label>
                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control" name="location">
                            </div>
                        </div>

                        <div>
                            <label for="owner" class="col-md-4 control-label">Owner</label>
                            <div class="col-md-6">
                                <input id="owner" type="text" class="form-control" name="owner">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
