@extends('layouts.master')

@section('top-menu')
<ul class="nav navbar-nav">

    <li><a href="{{url('dashboard')}}">Select Parsha</a></li>

    <li class="active">
        <a href="{{url('section/lists')}}"><span class="glyphicon glyphicon-th-list"></span> Sections</a>
    </li>

</ul>
@stop
@section('main-content')
<div class="jumbotron">
    @if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif

    <h3>Edit Section</h3>
    <form class="form-horizontal" action="{{url('section/update')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="id" value="{{$section->id}}"/>
        <div class="form-group">
            <label class="control-label col-md-3">Section Title</label>
            <div class="col-md-3">
                <input type="text" name="title" class="form-control" value="{{$section->title}}"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3 col-md-offset-3">
                <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i> Save Section</button>
            </div>
        </div>
    </form>



</div>
@stop