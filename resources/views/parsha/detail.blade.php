@extends('layouts.master')

@section('page-title')
: {{$parsha->text_eng.' '.$parsha->id}}
@stop

@section('top-menu')
<ul class="nav navbar-nav">

    <li class="active"><a href="{{url('parsha/'.$parsha->id)}}"><span class="glyphicon glyphicon-pencil"></span> Add/Edit Text</a></li>

    <li><a href="{{url('dashboard')}}"><span class="glyphicon glyphicon-remove"></span> Change Parsha</a></li>

</ul>
@stop

@section('main-content')

@stop