@extends('layout.master')
@section('content')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
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
                <form action="/cariadmin" method="get">
                    Cari Anggota <input type="text" name="id" placeholder="Masukkan NIK Pegawai" />
                    <input type="submit" name="Submit" value="cari">
                    
                    </form>
                    </br>
                    <a class="btn btn-danger" href="admin/create">Register Admin</a>
                    </br>
                </br>
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Admin yang terdaftar
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>User Role</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX">
                                            @foreach ($dataAdmin as $a)
                                            <td>{{$a->nik}}</td>
                                            <td>{{$a->nama}}</td>   
                                            <td>{{$a->username}}</td>
                                            <td>{{$a->password}}</td>
                                            <td>@if($a->user_role===1)
                                                Pengelola Simpanan
                                                @elseif($a->user_role===2)
                                                Pengelola Pinjaman
                                                @else
                                                Admin
                                                @endif</td>
                                            <td>@if($a->status_aktif===1)
                                                  Aktif
                                                  @else
                                                  Non Aktif
                                                  @endif</td>
                                            <td style="width: 12%">
                                            <form style="float:left;" action="admin/{{$a->id}}/edit" method="GET">
                                                {{ csrf_field() }}
                                                <button class="btn btn-primary" type="submit" name="edit"><i class="fa fa-edit fa-fw"></i></button>
                                            </form>
                                            <form style="float:right;" action="admin/{{$a->id}}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" type="submit" name="delete"><i class="fa fa-trash-o fa-fw" onclick="return confirm('Yakin ingin menghapus data?')"></i></button>
                                            </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                            </div>
                        </div>
                    </div>
                </div>


 @endsection
