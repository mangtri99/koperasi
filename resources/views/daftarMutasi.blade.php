@extends('layout.master')
@section('content') 


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            
                            <div class="panel-heading">
                                Daftar Mutasi
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if (count($mutasi) > 0)
                                            @if ((date("t") == date("j")) && ($mutasi[count($mutasi) - 1]->trx_tahun == date("Y") && $mutasi[count($mutasi) - 1]->trx_bulan != date("m")))
                                                <form action="/mutasi" method="POST">
                                                    @csrf
                            
                                                    <button type="submit" class="btn-create"><i class="fa fa-hourglass-half"></i>Proses Mutasi</button>
                                                </form>
                                            @endif
                                        @else
                                            @if(date("t") == date("j"))
                                                <form action="/mutasi" method="POST">
                                                    @csrf
                            
                                                    <button type="submit" class="btn-create"><i class="fa fa-hourglass-half"></i>Proses Mutasi</button>
                                                </form>
                                            @endif
                                        @endif
                                    
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Bulan</th>
                                                <th>Tahun</th>
                                                <th>Tanggal Mutasi</th>
                                                <th>Persentase Bunga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < count($mutasi); $i++)
                                                <tr>
                                                    <td>{{ $i+1 }}</td>
                                                    <td>{{ $mutasi[$i]->trx_bulan }}</td>
                                                    <td>{{ $mutasi[$i]->trx_tahun }}</td>
                                                    <td>{{ $mutasi[$i]->tanggal_proses }}</td>
                                                    <td>{{ $mutasi[$i]->persentase_bunga }}</td>
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
        </div>         
@endsection