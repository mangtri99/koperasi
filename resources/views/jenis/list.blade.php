@extends('layout.master')
@section('title','Data Anggota')
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
                    </br>
                    <a class="btn btn-danger" href="jenis/create">Tambah Jenis Transaksi</a>
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
                                            <th>No.</th>
                                            <th>Jenis Transaksi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX">
                                            @foreach ($data as $m)
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $m->transaksi }}</td>
                                            <td style="width: 12%">
                                            <form style="float:left;" action="/jenis/{{$m->id}}/edit" method="GET">
                                                {{ csrf_field() }}
                                                <button class="btn btn-primary" type="submit" name="edit"><i class="fa fa-edit fa-fw"></i></button>
                                            </form>
                                            <form style="float:right;" action="/jenis/{{$m->id}}/" method="post">
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
