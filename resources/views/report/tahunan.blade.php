@extends('layout.master')
@section('content')
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Report Tahunan</h3></div>
                    <div class="panel-body">

                    <div class="responsive-table">
                    <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                    <br>
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>Tahun</th>
                        <th>Bulan</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    @for ($i = 0; $i < sizeof($bulan); $i++)
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{ $tahun }}</td>
                        <td>{{ $bulan[$i] }}</td>
                        <td>{{ strstr($debit[$i], "-") ? 'Rp'.number_format(substr($debit[$i], 1),2,',','.') : $debit[$i] }}</td>
                        <td>{{ 'Rp'.number_format($kredit[$i], 2, ',','.') }}</td>   
                    </tr>
                    @endfor
                    <tr>
                        <td colspan="3">Total</td>
                        <td>{{ strstr($total_debit, "-") ? 'Rp'.number_format(substr($total_debit, 1),2,',','.') : $total_debit }}</td>
                        <td>{{ 'Rp'.number_format($total_kredit[$i], 2, ',','.') }}</td>
                    </tr>
                  
                      </tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </div>  
              </div>
          <!-- end: content -->
@endsection