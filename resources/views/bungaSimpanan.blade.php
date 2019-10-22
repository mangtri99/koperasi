@extends('layout.master')
@section('content') 
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Histori Presentase Bunga
                        </div>
                        <div class="panel-body">
                            </br>
                            <a class="btn btn-danger" href="bungaSimpanan/create">Register Master Bunga</a>
                            </br>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Presentase Bunga</th>
                                                <th>Tanggal Berlaku</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                @for ($i = 0; $i < count($bungas); $i++)
                                                <td>{{$i + 1}}</td>
                                                <td>{{$bungas[$i]->persentase}}%</td>
                                                <td>{{$bungas[$i]->tanggal_mulai_berlaku}}</td>
                                                <td style="width: 12%">
                                                <form style="float:left;" action="bungaSimpanan/{{$bungas[$i]->id}}/edit" method="GET">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-primary" type="submit" name="edit"><i class="fa fa-edit fa-fw"></i></button>
                                                </form>
                                                <form style="float:right;" action="bungaSimpanan/{{$bungas[$i]->id}}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger" type="submit" name="delete"><i class="fa fa-trash-o fa-fw" onclick="return confirm('Yakin ingin menghapus data?')"></i></button>
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
        </div>
        </div>         
@endsection
