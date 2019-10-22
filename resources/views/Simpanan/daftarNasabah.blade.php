@extends('layout.master')
@section('content')
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
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Daftar Nasabah</h3></div>
                    <div class="panel-body">

                    <form action="/cariSimpanan" method="GET">
                        <input type="text" name="no_anggota" placeholder="Masukan No. Anggota">
                        <button type="submit">cari</button>
                    </form>

                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <br>
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>No. Anggota</th>
                          <th>Nama</th>
                          <th>Alamat</th>
                          <th>Telepon</th>
                          <th>No. KTP</th>
                          <th>Jenis Kelamin</th>
                          <th>Saldo</th>
                          <th>Status Aktif</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @for ($i = 1; $i <= sizeof($nasabah); $i++)
                        @if($nasabah[$i-1]->status_aktif == 1)
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ $nasabah[$i-1]->no_anggota }}</td>
                          <td>{{ $nasabah[$i-1]->nama }}</td>
                          <td>{{ $nasabah[$i-1]->alamat }}</td>
                          <td>{{ $nasabah[$i-1]->telepon }}</td>
                          <td>{{ $nasabah[$i-1]->noktp }}</td>
                          <td> @if($nasabah[$i-1]->kelamin_id===1)
                              Laki-laki
                              @else
                              Perempuan
                              @endif</td>
                            <td>{{$saldo[$i-1]}}</td>
                          <td>@if ($nasabah[$i-1]->status_aktif== 1)
                                Aktif
                              @else
                                Nonaktif</td>
                              @endif
                          <td>
                            <form action="/simpanan/{{$nasabah[$i-1]->id}}/create" method="GET">
                                    <button type="submit">
                                        <div class="edit">Tambah Transaksi</div>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endif
                      @endfor
                      </tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </div>  
              </div>
          <!-- end: content -->
@endsection