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
                                        <th>No</th>
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
                                        @php ($no=1)
                                        <td>{{$no++}}
                                        <td>{{$ambildata->nik}}</td>
                                        <td>{{$ambildata->nama}}</td>   
                                        <td>{{$ambildata->username}}</td>
                                        <td>{{$ambildata->password}}</td>
                                        <td>@if($ambildata->kelamin_id===1)
                                                  Laki-laki
                                                  @else
                                                  Perempuan
                                                  @endif</td>
                                        <td>@if($ambildata->status_aktif===1)
                                                  Aktif
                                                  @else
                                                  Non Aktif
                                                  @endif</td>
                                        <td style="width: 12%">
                                        <form style="float:left;" action="admin/{{$ambildata->id}}/edit" method="GET">
                                            {{ csrf_field() }}
                                            <button class="btn btn-primary" type="submit" name="edit"><i class="fa fa-edit fa-fw"></i></button>
                                        </form>
                                        <form style="float:right;" action="admin/{{$ambildata->id}}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-danger" type="submit" name="delete"><i class="fa fa-trash-o fa-fw" onclick="return confirm('Yakin ingin menghapus data?')"></i></button>
                                        </form>
                                        </td>
                                    </tr>
                                
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