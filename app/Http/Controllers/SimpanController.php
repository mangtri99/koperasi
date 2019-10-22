<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\BungaSimpanan;
USE App\Simpanan;
USE App\Anggota;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SimpanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //
    } 

    public function ShowMember()
    {  

        if (Session::get('login')){
            $nasabah = Anggota::get();
            for($i = 0; $i < count($nasabah); $i++){
                $saldo[$i] = Simpanan::where("anggota_id", $nasabah[$i]->id)->sum("nominal_transaksi");
            }
        
            return view('simpanan.daftarNasabah', compact("nasabah", "simpanan","saldo"));
        }
        else{
            return "<script>
                alert('Anda Belum Login');
                window.location.href='/';
                </script>";
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create($id)
    {
        if (Session::get('login')){
            $simpanan = Simpanan::query()->select(['tanggal', 'jenis_transaksi', 'nominal_transaksi'])
            ->where('anggota_id', $id)->limit(10)->orderBy('id','DESC')->getQuery()->get();
            $nasabah = Anggota::find($id);
            for($i = 0; $i < count($nasabah); $i++){
                $saldo = Simpanan::where("anggota_id", $id)->sum("nominal_transaksi");
            }
            $saldoSementara=$saldo;
            
            return view('simpanan.transaksiSimpanan', compact("nasabah","simpanan","saldo","data","saldoSementara"));
        }
        else{
            return "<script>
                alert('Anda Belum Login');
                window.location.href='/';
                </script>";
        }
        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nasabah = Anggota::get();
        $simpanan = new Simpanan;
        $simpanan->anggota_id = $request->anggota_id;
        $anggota_id= $request->anggota_id;
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $simpanan->tanggal = date("Y-m-d H-i-s");
        $simpanan->jenis_transaksi = $request->transaksi;

        if($request->transaksi==1){
            $simpanan->nominal_transaksi = $request->nominal;
        }
        
        else{
            $saldo = Simpanan::where("anggota_id", $request->anggota_id)->sum("nominal_transaksi");
            if($saldo >= $request->nominal){
                $simpanan->nominal_transaksi = $request->nominal*(-1);
            }
            elseif($saldo < $request->nominal){
                return "<script>
                alert('Saldo tidak cukup!');
                window.location.href='/simpanan/$anggota_id/create';
                </script>";
            }
            
        }
        
        $simpanan->id_user = Session::get('id');

        $simpanan->save();
        
        return redirect("/simpanan/$anggota_id/create")->with('alert-success','Transaksi Berhasil');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (Session::get('login')){
            $simpanan = Simpanan::get();
            
            return view('simpanan.tabelSimpanan', compact("simpanan"));
        }
        else{
            return "<script>
            alert('Anda Belum Login');
            window.location.href='/';
            </script>";
        }
        
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (Session::get('login')){
        //     $simpanan = Simpanan::find($id);
        //     return view("simpanan.editSimpanan", compact("simpanan"));
        // }
        // else{
        //     return "<script>
        //         alert('Anda Belum Login');
        //         window.location.href='/';
        //         </script>";
        // }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $simpanan = Simpanan::find($id);
        // $simpanan->anggota_id = $request->anggota_id;
        // $simpanan->tanggal = date("Y-m-d");
        // $simpanan->jenis_transaksi = $request->transaksi;
        // if($request->transaksi==1){
        //     $simpanan->nominal_transaksi = $request->nominal;
        // }
        // else{
        //     $simpanan->nominal_transaksi = $request->nominal*(-1);
        // }
        
        // $simpanan->id_user = Session::get('id');

        // $simpanan->save();
        // return "<script>
        //         alert('Berhasil Mengedit Transaksi');
        //         window.location.href='/simpanan/show';
        //         </script>";
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $simpanan = Simpanan::find($id);
        // $simpanan->delete();
        // return "<script>
        //         alert('Berhasil Menghapus Transaksi');
        //         window.location.href='/simpanan/show';
        //         </script>";
    
    }

    public function cari(Request $request){

        if (Session::get('login')){
            $nasabah = Anggota::where("status_aktif", 1)->where("no_anggota", $request->no_anggota)->first();
            $jumlah=count($nasabah);
            if($jumlah>0){
                $simpanan = Simpanan::where('anggota_id', $nasabah->id)->limit(10)->orderBy('id','DESC')->get();
                for($i = 0; $i < count($nasabah); $i++){
                    $saldo = Simpanan::where("anggota_id", $nasabah->id)->sum("nominal_transaksi");
                }
                $saldoSementara=$saldo;
                return view('simpanan.transaksiSimpanan', compact("nasabah","simpanan","saldo","saldoSementara"));
            }else{
               
                return redirect()->action('SimpanController@showMember')->with('alert','No. Anggota tidak ada!');
            }

        }
        else{
            return "<script>
                alert('Anda Belum Login');
                window.location.href='/';
                </script>";
        }
    }
    
}
