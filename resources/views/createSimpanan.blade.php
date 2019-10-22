@extends('layout.master')
@section('content')
        <div class="content">
            <div class="container-fluid">
                <div class="row"> 
                    <h1> Hi {{Session::get('nama')}} <h1> 
                    </div>      
                <div class="row">  
                	
<form action="/cariAnggota" class="container" method="get">
	@csrf
	<label for="nama">Nomor Anggota :</label>
	<div class="form-group">
		<input type="text" class="form-control" name="no_anggota" required=""  />
	</div>
	<center>
		 <div class="form-group">
			<input type="submit" name="cek" value="cek anggota" class="btn btn-primary">
	    </div>
	</center>
</form>

@if(!empty($hasil))
<form action="/simpanan" class="container" method="post">
  @csrf
  <h2 align="left"> Nomor Anggota : {{$hasil->no_anggota}} </h2>
  <h2 align="left"> Nama Anggota :{{$hasil->nama}} </h2>
  <h2 align="left"> Saldo : {{$hasil->saldo}} </h2>
  
  <div class="form-group">
    <input type="text" hidden="" name="id_anggota" value="{{$hasil->anggota_id}}" />
  </div>
  <br><br>

	<div class="form-grup">
        <label for="gender">Jenis Transaksi:</label>
        
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="id_jenis_transaksi" value="1">Simpanan
          </label> 
        </div>

        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="id_jenis_transaksi" value="2">Penarikan
          </label> 
        </div>
        
  </div>
      <br>
	<label for="nama">Nominal :</label>
		<div class="form-group">
			<input type="text" class="form-control" name="nominal" required=""/>
	    </div>

	    <center>
		 <div class="form-group">
			<input type="submit" class="btn btn-primary btn-lg" value="Tambahkan" />
	    </div>
	    </center>	
</form>	
@endif
                    </div>                      
            </div>
        </div>
 @endsection