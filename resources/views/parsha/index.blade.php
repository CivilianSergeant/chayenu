@extends('layouts.master')

@section('page-title')
| New Parsha
@stop

@section('top-menu')
<ul class="nav navbar-nav">

    <li class="active"><a href="{{url('parsha/new')}}"><span class="glyphicon glyphicon-pencil"></span> Add Parsha</a></li>
    <li><a href="{{url('parsha/lists')}}"><span class="glyphicon glyphicon-list"></span> Parsha List</a></li>
    <li><a href="{{url('dashboard')}}"><span class="glyphicon glyphicon-remove"></span> Change Parsha</a></li>

</ul>
@stop

@section('main-content')

    <div class="col-md-12 jumbotron">
        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
        <form action="{{url('parsha/create')}}" method="post" class="form-horizontal">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
                <label class="control-label col-md-3">Parsha Name <span class="text-danger">*</span></label>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="parsha_name" value="{{old('parsha_name')}}"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Start Date</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="start_date" value="{{old('start_date')}}"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">End Date</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="end_date" value="{{old('end_date')}}"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3 col-md-offset-3">
                    <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i> Save Parsha</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
$("input[name=start_date],input[name=end_date]").datepicker({
    dateFormat:'yy-mm-dd'
});
</script>
@stop