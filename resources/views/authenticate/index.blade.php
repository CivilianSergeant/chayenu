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



    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug 

    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">-->



    <!-- Custom styles for this template 

    <link href="signin.css" rel="stylesheet">-->



    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->

    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]

    <script src="js/ie-emulation-modes-warning.js"></script>-->



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

  </head>



  <body>



    <div class="container">



      <form class="form-signin" action="{{url('authenticate')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <h2 class="form-signin-heading">Chayenu Uploading</h2>

        <label for="inputEmail" class="sr-only">Email address</label>

        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>

        <label for="inputPassword" class="sr-only">Password</label>

        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>

        <div class="checkbox">

          <label>

            <input type="checkbox" value="remember-me"> Remember me

          </label>

        </div>

        <button  class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

      </form>
      <br/>
      @if(Session::has('message'))
      <div class="alert alert-warning">
        <!-- <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> -->
        <strong>Opps!</strong> {{Session::get('message')}}
      </div>
      @endif

    </div> <!-- /container -->





    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug 

    <script src="js/ie10-viewport-bug-workaround.js"></script>-->

  </body>

</html>

