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
                <form action="/carinasabah" method="get">
                    Cari Anggota <input type="text" name="id" placeholder="Masukkan No Anggota" />
                    <input type="submit" name="Submit" value="cari">
                </br>
                </br>

                    <a class="btn btn-danger" href="anggota/create">Register Nasabah</a>
                    </form>
                    </br>
                    </br>
        
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Anggota yang telah terdaftar
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No.Anggota</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>No.Telepon</th>
                                            <th>No.KTP</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                            <th>Riwayat Transaksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX">
                                            @for ($i = 0; $i < count($dataAnggota); $i++)
                                            <td>{{$i + 1}}</td>
                                            <td>{{$dataAnggota[$i]->no_anggota}}</td>
                                            <td>{{$dataAnggota[$i]->nama}}</td>   
                                            <td>{{$dataAnggota[$i]->alamat}}</td>
                                            <td>{{$dataAnggota[$i]->telepon}}</td>
                                            <td>{{$dataAnggota[$i]->noktp}}</td>
                                            <td>{{$dataAnggota[$i]->kelamin_id == 1 ? "Laki-laki" : "Perempuan"}}</td>
                                            <td>{{$dataAnggota[$i]->status_aktif == 1 ? "Aktif" : "NonAktif"}}</td>
                                            <td style="width: 12%">
                                            <form style="float:left;" action="anggota/{{$dataAnggota[$i]->id}}/edit" method="GET">
                                                {{ csrf_field() }}
                                                <button class="btn btn-primary" type="submit" name="edit"><i class="fa fa-edit fa-fw"></i></button>
                                            </form>
                                            <form style="float:right;" action="anggota/{{$dataAnggota[$i]->id}}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" type="submit" name="delete"><i class="fa fa-trash-o fa-fw" onclick="return confirm('Yakin ingin menghapus data?')"></i></button>
                                            </form>
                                            <td>
                                            <form action="/anggota/{{$dataAnggota[$i]->id}}" method="get">
                                             @csrf
                                            <button class="btn btn-primary"><i class="fa fa-search"></i> Detail</button> 
                                            </form>   
                                            </td>

                                        </tr>
                                        @endfor
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