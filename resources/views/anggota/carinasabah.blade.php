@extends('layout.master')
@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row"> 
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Hasil yang ditemukan
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
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX">
                                            @php ($no=1)
                                           
                                            <td>{{$no++}}</td> 
                                            <td>{{$ambildata->no_anggota}}</td>
                                            <td>{{$ambildata->nama}}</td>   
                                            <td>{{$ambildata->alamat}}</td>
                                            <td>{{$ambildata->telepon}}</td>
                                            <td>{{$ambildata->noktp}}</td>
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
                                            <form style="float:left;" action="anggota/{{$ambildata->id}}/edit" method="GET">
                                                {{ csrf_field() }}
                                                <button class="btn btn-primary" type="submit" name="edit"><i class="fa fa-edit fa-fw"></i></button>
                                            </form>
                                            <form style="float:right;" action="anggota/{{$ambildata->id}}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" type="submit" name="delete"><i class="fa fa-trash-o fa-fw" onclick="return confirm('Yakin ingin menghapus data?')"></i></button>
                                            </form>
                                            </td>
                                            <td>
                                            <form action="/anggota/{{$dataAnggota[$i]->id}}" method="post">
                                            @method("get")
                                             @csrf
                                            <button class="btn btn-primary"><i class="fa fa-search"></i> Detail</button> 
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
