@extends('layouts.master')

@section('top-menu')
<ul class="nav navbar-nav">

  <li class="active"><a href="{{url('dashboard')}}">Select Parsha</a></li>

  <li>
    <a href="{{url('section')}}"><span class="glyphicon glyphicon-th-list"></span> Sections</a>
  </li>

</ul>
@stop

@section('main-content')
<div class="jumbotron">

    <h2>Select Parsha</h2>



    <select id="parshaList" style="padding:10px;">
      <option value="">Please Select</option>
      @foreach($parshas as $parsha)
      <option value="{{$parsha->id}}">{{$parsha->text_eng.' '.$parsha->id}}</option>
      @endforeach
   </select>



   <br><br>



  <button class="btn btn-info btn-lg" type="button">Add Parsha</button>



</div>
@stop
@section('scripts')
<script type="text/javascript">
  $(function(){

    $("#parshaList").change(function(){
        var id = $(this).val();
        if(id!=null)
          window.location = "{{url('parsha')}}/"+id;
    });

  });
</script>
@stop