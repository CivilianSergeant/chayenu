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
    @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif

    @if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif

    <h2>Sections</h2>


    <p>Drag to re-order</p>


    <table class="table table-striped" id="sort">

        <thead>

        <th>Action</th>

        <th>Name</th>

        <!--<th>Template</th>-->

        </thead>

        <tbody>
        @if(!empty($sections))
        @foreach($sections as $section)
        <tr id="{{$section->id}}">
            <td>
                <a class="btn btn-info btn-sm" href="{{url('section/edit/'.$section->id)}}">Edit</a>
                <a class="btn btn-danger btn-sm" href="{{url('section/delete/'.$section->id)}}">Delete</a>
            </td>

            <td>{{$section->title}}</td>

            <!--<td>english-only</td>-->

        </tr>
        @endforeach
        @endif
        </tbody>
    </table>

    <a class="btn btn-default btn-large" href="{{url('section/new')}}">
        <span class="glyphicon glyphicon-plus"></span> Add Section
    </a>
</div>
@stop

@section('scripts')
<script type="text/javascript">
    $("#sort tbody").sortable({
        update: function (even, ui) {
            var sortedIDs = $("#sort tbody").sortable("toArray");
            var token = "{{csrf_token()}}";

            $.ajax({
                type:"POST",
                url: "{{url('section/update-order')}}",
                data: {order:sortedIDs,_token:token},
                success:function(e){
                    console.log(e);
                }
            })
        }
    });
</script>
@stop