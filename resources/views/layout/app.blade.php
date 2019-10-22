<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('tittle')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <style type="text/css">
      body{
        font-family: 'Nunito', sans-serif;
        font-weight: 550;
      }
    </style>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body>
  <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
     <a class="navbar-brand" href="/" style="color: dodgerblue;">   KOPERASI ETIKA DANA</a>
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse collapse" id="navbarsExample04" style="">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/anggota" style="color: dodgerblue;">Data Anggota <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="/jenis" style="color: dodgerblue;">Jenis Transaksi <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav><br><br>
    <div class="container-fluid">
        <div class="jumbotron text-center">
          <div class="text-center" style="color: dodgerblue;">
                <h2>Welcome Everyone.</h2>
          </div>
        </div>
    </div>
    <div class="container" style="border: 1px solid dodgerblue;padding-top: 20px;padding-bottom: 20px;margin-bottom: 20px;border-radius: 10px;">
      <div class="row">
        <div class="col-sm-12">
        @yield('content')     
        </div>
      </div>
    </div>
    <footer class="container-fluid text-center">

    Copyright &copy; Koperasi Etika Dana 
    
  </footer>
</body>
    
</html>