@extends('layouts.master')


@section('top-menu')
<ul class="nav navbar-nav">

    <li ><a href="{{url('parsha/new')}}"><span class="glyphicon glyphicon-pencil"></span> Add Parsha</a></li>
    <li class="active"><a href="{{url('parsha/lists')}}"><span class="glyphicon glyphicon-list"></span> Parsha List</a></li>
    <li><a href="{{url('dashboard')}}"><span class="glyphicon glyphicon-remove"></span> Change Parsha</a></li>

</ul>
@stop

@section('main-content')
<div class="col-md-12 jumbotron">
    @if(Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Action</th>
                <th>Name</th>

            </tr>
        </thead>
        <tbody>
        @if(!empty($parshas))
            @foreach($parshas as $parsha)
            <tr>
                <td>
                    <a class="btn btn-info btn-sm" href="{{url('parsha/edit/'.$parsha->id)}}">Edit</a>
                    <a class="btn btn-danger btn-sm" href="{{url('parsha/delete/'.$parsha->id)}}">Delete</a>
                </td>
                <td>{{$parsha->parsha_name}}</td>
            </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
@stop