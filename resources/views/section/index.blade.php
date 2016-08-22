@extends('layouts.master')

@section('top-menu')
<ul class="nav navbar-nav">

  <li class="active"><a href="{{url('dashboard')}}">Select Parsha</a></li>

  <li class="active">
    <a href="{{url('section')}}"><span class="glyphicon glyphicon-th-list"></span> Sections</a>
  </li>

</ul>
@stop
@section('main-content')
<div class="jumbotron">

        <h2>Sections</h2>



        <p>Drag to re-order</p>



      <table class="table table-striped" id="sort">

      <thead>

        <th>Action</th>

        <th>Name</th>

        <th>Template</th>

      </thead>

      <tbody>

      <tr>

        <td><button class="btn btn-info btn-sm" href="#">Edit</button> <button class="btn btn-danger btn-sm" href="#">Delete</button></td>

        <td>Parsha Overview</td>

        <td>english-only</td>

      </tr>

      <tr>

        <td><button class="btn btn-info btn-sm" href="#">Edit</button> <button class="btn btn-danger btn-sm" href="#">Delete</button></td>

        <td>Chumash</td>

        <td>chumash</td>

      </tr>

      <tr>

        <td><button class="btn btn-info btn-sm" href="#">Edit</button> <button class="btn btn-danger btn-sm" href="#">Delete</button></td>

        <td>Tanya</td>

        <td>tanya</td>

      </tr>

      <tr>

        <td><button class="btn btn-info btn-sm" href="#">Edit</button> <button class="btn btn-danger btn-sm" href="#">Delete</button></td>

        <td>Rambam</td>

        <td>rambam</td>

      </tr>

      <tr>

        <td><button class="btn btn-info btn-sm" href="#">Edit</button> <button class="btn btn-danger btn-sm" href="#">Delete</button></td>

        <td>Hayom yom</td>

        <td>hayom-yom</td>

      </tr>

      <tr>

        <td><button class="btn btn-info btn-sm" href="#">Edit</button> <button class="btn btn-danger btn-sm" href="#">Delete</button></td>

        <td>Rebbe Responsa</td>

        <td>english-only</td>

      </tr>

      </tbody>



      </table>



      <button class="btn btn-default btn-large" href='#'><span class="glyphicon glyphicon-plus"></span> Add Section</button>



      </div>
@stop