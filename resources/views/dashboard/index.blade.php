@extends('layouts.master')

@section('top-menu')
<ul class="nav navbar-nav">

  <li class="active"><a href="{{url('dashboard')}}">Select Parsha</a></li>

  <li>
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
    <h2>Select Parsha</h2>



    <select id="parshaList" style="padding:10px;">
      <option value="">Please Select</option>
      @foreach($parshas as $parsha)
      <option value="{{$parsha->id}}">{{$parsha->parsha_name.' '.$parsha->id}}</option>
      @endforeach
   </select>



   <br><br>



  <a href="{{url('parsha/new')}}" class="btn btn-info btn-lg" >Add Parsha</a>



</div>
@stop
@section('scripts')
<script type="text/javascript">
  $(function(){

    $("#parshaList").change(function(){
        var id = $(this).val();
        if(id!=null)
          window.location = "{{url('text')}}/"+id;
    });

  });
</script>
@stop