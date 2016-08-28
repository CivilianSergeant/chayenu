<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="description" content="">

    <meta name="author" content="">

    <link rel="icon" href="../../favicon.ico">



    <title>Chayenu Uploading System</title>



    <!-- Bootstrap core CSS -->

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('js/jquery-ui-1.12.0/jquery-ui.min.css')}}" rel="stylesheet">
    <link href="{{asset('js/jquery-ui-1.12.0/jquery-ui.theme.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <script  type="text/JavaScript"  src="https://code.jquery.com/jquery-1.12.4.min.js"   ></script>
    <script  type="text/JavaScript"  src="{{asset('js/jquery-ui-1.12.0/jquery-ui.min.js')}}"   ></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug 

    <link href="{{asset('css/ie10-viewport-bug-workaround.css')}}" rel="stylesheet">-->



    <!-- Custom styles for this template 

    <link href="navbar.css" rel="stylesheet">-->



    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->

    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]

    <script src="{{asset('js/ie-emulation-modes-warning.js')}}"></script>-->



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

    


  </head>



  <body>



    <div class="container">



      <!-- Static navbar -->

      <nav class="navbar navbar-default">

        <div class="container-fluid">

          <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

              <span class="sr-only">Toggle navigation</span>

              <span class="icon-bar"></span>

              <span class="icon-bar"></span>

              <span class="icon-bar"></span>

            </button>

            <a class="navbar-brand" href="dashboard.html">Chayenu Uploading @yield('page-title')</a>

          </div>

          <div id="navbar" class="navbar-collapse collapse">



            @yield('top-menu')



            <ul class="nav navbar-nav navbar-right">

              <li><a href="{{url('logout')}}">Logout</a></li>

            </ul>

          </div><!--/.nav-collapse -->

        </div><!--/.container-fluid -->

      </nav>



      <!-- Main component for a primary marketing message or call to action -->

      @yield('main-content')

      <!-- end main content -->

    </div> <!-- /container -->





    <!-- Bootstrap core JavaScript

    ================================================== -->

    <!-- Placed at the end of the document so the pages load faster -->

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery.min.js')}}"><\/script>')</script>
    -->
    
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug 

    <script src="{{asset('js/ie10-viewport-bug-workaround.js')}}"></script>-->
    @yield('scripts')
  </body>

</html>

