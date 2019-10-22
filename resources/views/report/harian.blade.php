@extends('layout.master')
@section('content')
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Report Harian</h3></div>
                    <div class="panel-body">
                     
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <br>
                      <thead>
                        <tr>
                          <th>NO</th>
                          <th>Tanggal</th>
                          <th>Debit</th>
                          <th>Kredit</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $tanggal }}</td>
                            <td>{{ strstr($debit, "-") ? 'Rp'.number_format(substr($debit, 1),2,',','.') : $debit }}</td>
                            <td>{{ 'Rp'.number_format($kredit, 2, ',','.') }}</td>   
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