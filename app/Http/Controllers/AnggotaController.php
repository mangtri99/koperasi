<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 
use DB;

class AnggotaController extends Controller
{
    public function index()

    {
        $dataAnggota = DB::table('tb_anggota')
        ->get();

        return view('anggota.daftarAnggota',compact('dataAnggota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('anggota.createAnggota');
    }

    /*Denis Develovment Started Here*/
    public function viewSimpanan()
    {
        $dataSimpanan = DB::table('tb_simpanan');
        return view('viewSimpanan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tahun = date("Y");
        $nomor = $tahun.'000';
        for($i=1;$i<=100;$i++){
            $datanomor=Anggota::where('no_anggota', $nomor + 1)->count();
            if($datanomor>0){
                $nomor +=1;
            }elseif($datanomor==0){
                $nomor +=1;
                break;
            }
        }

        $validate = \Validator::make($request->all(),[
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'ktp' => 'required',
            'kelamin' => 'required',
            'status' => 'required',
        ]);
        if($validate->fails()){
            $anggotas = Anggota::get();
            return redirect()->action("AnggotaController@create")->with('alert','harap dilengkapi');
        }
        // $no=$request->nomer;
        // $ambildata = Anggota::where(['no_anggota'=>$no])->first();
        // if($ambildata){
        //     return redirect()->back()->with('alert','No Anggota telah terdaftar');
        // }
        else{
        $no = $nomor;
        $nama = $request->input('nama');
        $alamat = $request->input('alamat');
        $telp = $request->input('telp');
        $ktp=$request->input('ktp');
        $jk = $request->input('kelamin');
        $status=$request->input('status');
        $idUser=Session::get('id');

        DB::table('tb_anggota')->insert(
            [
            'no_anggota' => $no, 
            'nama' => $nama,
            'alamat' => $alamat,
            'telepon' => $telp,
            'noktp' => $ktp,
            'kelamin_id' => $jk,
            'user_id' => $idUser,
            'status_aktif' => $status
            ]
        );

        return redirect('/anggota')->with('alert-success','Berhasil Menambahkan Data');
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $simpanan = DB::table('tb_simpanan')
        ->join('tb_anggota', 'tb_simpanan.anggota_id', '=', 'tb_anggota.id')
        ->join('tb_users', 'tb_simpanan.id_user', '=', 'tb_users.id')
        ->join('tb_jenis_transaksi', 'tb_simpanan.jenis_transaksi', '=', 'tb_jenis_transaksi.id')
        ->select('tb_simpanan.*', 'tb_anggota.nama as anggota', 'tb_users.nama as user', 'tb_jenis_transaksi.transaksi as jenis_transaksi')
        ->where('tb_simpanan.anggota_id', '=', $id)
        ->get();
        $detail = DB::table('tb_anggota')
        ->get();
        return view('anggota.detailAnggota', compact('simpanan','detail'));

     
    }

    public function update(Request $request, $id)
    {

        $no = $request->input('nomer');
        $nama = $request->input('nama');
        $alamat = $request->input('alamat');
        $telp = $request->input('telp');
        $ktp=$request->input('ktp');
        $jk = $request->input('kelamin');
        $status=$request->input('status');

        DB::table('tb_anggota')
        ->where('id',$id)
        ->update(
            [
            'no_anggota' => $no, 
            'nama' => $nama,
            'alamat' => $alamat,
            'telepon' => $telp,
            'noktp' => $ktp,
            'kelamin_id' => $jk,
            'status_aktif' => $status
            ]
        );

        return redirect('/anggota')->with('alert-success','Berhasil Menambahkan Data');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anggota = DB::table('tb_anggota')
        ->where(['id'=>$id])
        ->get();
        return view('anggota.editAnggota',compact('anggota'));
    }

    public function destroy($id)
    {
        Anggota::find($id)->update(['status_aktif' => 0]);
        return redirect('/anggota');
    }


}
