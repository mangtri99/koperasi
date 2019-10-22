<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Form login Koperasi</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{URL::asset('assets/css/animate.min.css')}}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{URL::asset('assets/css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{URL::asset('assets/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <h3> KOPERASI SIMPAN PINJAM KELOMPOK 7 </h3>
                <br />
            </div>
        </div>
      <div class="row ">
      @if(\Session::has('alert'))
                    <div class="alert alert-danger">
                        <div>{{Session::get('alert')}}</div>
                    </div>
                        @endif
                        @if(\Session::has('alert-success'))
                            <div class="alert alert-success">
                                <div>{{Session::get('alert-success')}}</div>
                            </div>
                        @endif
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
          <div class="panel panel-default">
            <div class="panel-heading">
             <strong>Masukkan Username dan Password</strong>  
            </div>
        <div class="panel-body">

          <form role="form" action="/login" method="POST" >
            {{ csrf_field() }}
            <br />
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
              <input type="text" name="username" class="form-control" placeholder="Masukkan Username " />
                </div>
              <div class="form-group input-group">
           <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
         <input type="password" name="password" class="form-control"  placeholder="Masukkan Password" />
      </div>
                                     
         <br/>
      <button type="submit" class="btn btn-primary">Login Now</button>
         <hr />
          </form>
         </div>
       </div>
     </div>
   </div>
</div>

    <script src="{{ URL::asset('assets/js/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
   
</body>
</html>
