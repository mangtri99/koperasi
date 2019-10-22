<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Koperasi Kelompok 7</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{URL::asset('master/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{URL::asset('master/css/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="{{URL::asset('master/css/timeline.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{URL::asset('master/css/startmin.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="master/css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="master/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
</body>
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Startmin</a>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Top Navigation: Left Menu -->
        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li>
        </ul>

        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">
            <li class="dropdown navbar-inverse">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> secondtruth <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">

                <ul class="nav" id="side-menu">
                    <center>
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                       <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                      <h4>KELOMPOK 7</h4>
                                    </button>
                                </span>
                        </div>
                    </li>
                    </center>
                    <li>
                        <a href="/dashboard" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> Master Data<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/anggota">Daftar Nasabah <span class="fa arrow"></a>
                            </li>
                            <li>
                                <a href="/admin">Daftar Pegawai <span class="fa arrow"></span></a>
                            </li>
                            <li>
                                <a href="/bungaSimpanan">Bunga <span class="fa arrow"></span></a>
                            </li>
                            <li>
                                <a href="/jenis">Jenis Transaksi <span class="fa arrow"></span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> Master Transaksi<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/simpanan">Simpanan dan Penarikan<span class="fa arrow"></span></a>
                            </li>
                            <li>
                                <a href="#">Perhitungan Bunga <span class="fa arrow"></span></a>
                            </li>
                            <li>
                                <a href="#">Koreksi <span class="fa arrow"></span></a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> Master Report<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Laporan Tahunan<span class="fa arrow"></span></a>
                            </li>
                            <li>
                                <a href="#">Laporan Bulanan<span class="fa arrow"></span></a>
                            </li>
                            <li>
                                <a href="#">Laporan Mingguan<span class="fa arrow"></span></a>
                            </li>
                            <li>
                                <a href="#">Laporan Harian<span class="fa arrow"></span></a>
                            </li>
                            
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">KOPERASI SIMPAN PINJAM</h1>
                </div>
            </div>

                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Bunga
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="post" action="/bungaSimpanan/{{$bunga->id}}" role="form">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input class="form-control" name="persentase" placeholder="Persentase Bunga" value="{{$bunga->persentase}}" />
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="date" name="tanggal_mulai_berlaku" placeholder="Tanggal Mulai Berlaku" value="{{$bunga->tanggal_mulai_berlaku}}" />
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-lg">SIMPAN</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
               <!-- jQuery -->
<script src="{{URL::asset('master/js/jquery.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{URL::asset('master/js/bootstrap.min.js') }}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{URL::asset('master/js/metisMenu.min.js') }}"></script>

<!-- Custom Theme JavaScript -->
<script src="{{URL::asset('master/js/startmin.js') }}"></script>
   
   
</body>
</html>
