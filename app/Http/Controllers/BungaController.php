<?php

namespace App\Http\Controllers;

use App\BungaSimpanan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BungaController extends Controller
{
    public function index()
    {
        $session = Session::all();
        if(isset($session['id'])){
            $bungas = BungaSimpanan::get();
            $user = User::find($session['id']);

            if($user->user_role == 1){
                return view("bungaSimpanan", compact("user", "bungas"));
            } else {
                return redirect()->action("UserController@index");
            }
        } else {
            return redirect("/");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $session = Session::all();
        if(isset($session['id'])){
            $user = User::find($session['id']);
            
            if($user->user_role == 1){
                return view("createBungaSimpanan", compact("user"));
            } else {
                return redirect()->action("UserController@login");
            }
        } else {
            return redirect("/");
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
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $bulan = date("m", strtotime($request->tanggal_mulai_berlaku));
        $tahun = date("Y", strtotime($request->tanggal_mulai_berlaku));
        $bulanSekarang = date("m");
        $tahunSekarang = date("Y");

        if($tahun > $tahunSekarang) {
            $bunga = new BungaSimpanan;
            $bunga->persentase = $request->persentase;
            $bunga->tanggal_mulai_berlaku = $request->tanggal_mulai_berlaku;
            $bunga->save();

            return redirect()->action("BungaController@index")->with('success', 'Berhasil menambahkan bunga simpanan');
        } elseif($tahun == $tahunSekarang && $bulan > $bulanSekarang){
            $bunga = new BungaSimpanan;
            $bunga->persentase = $request->persentase;
            $bunga->tanggal_mulai_berlaku = $request->tanggal_mulai_berlaku;
            $bunga->save();

            return redirect()->action("BungaController@index")->with('success', 'Berhasil menambahkan bunga simpanan');
        } else {
            return redirect()->action("BungaController@create")->with('error', 'Tanggal sudah lewat');;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $session = Session::all();
        if(isset($session['id'])){
            $user = User::find($session['id']);
            
            if($user->user_role == 1){
                $bunga = BungaSimpanan::find($id);
                return view("editBungaSimpanan", compact("user", "bunga"));
            } else {
                return redirect()->action("UserController@index");
            }
        } else {
            return redirect("/sign-in");
        }
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
        if(isset($request->tanggal_mulai_berlaku) && isset($request->persentase)){
            $bunga = BungaSimpanan::find($id);
            $bulan_mulai_berlaku = date("m", strtotime($request->tanggal_mulai_berlaku));
            $bulan_mulai_berlaku_db = date("m", strtotime($bunga->tanggal_mulai_berlaku));
            $tahun_mulai_berlaku = date("Y", strtotime($request->tanggal_mulai_berlaku));
            $tahun_mulai_berlaku_db = date("Y", strtotime($bunga->tanggal_mulai_berlaku));
            $tanggal_mulai_berlaku = date_create($request->tanggal_mulai_berlaku);
            $tanggal_sekarang = date_create("now");
            $perbedaan_tanggal = date_diff($tanggal_sekarang, $tanggal_mulai_berlaku);

            if($perbedaan_tanggal->format("%R") == "+"){
                if($tahun_mulai_berlaku == $tahun_mulai_berlaku_db && $bulan_mulai_berlaku == $bulan_mulai_berlaku_db){
                    $bunga->persentase = $request->persentase;
                    $bunga->tanggal_mulai_berlaku = $request->tanggal_mulai_berlaku;

                    $bunga->save();

                    return redirect()->action("BungaSimpananController@index")->with('success', 'Berhasil mengubah data bunga simpanan');
                } else {
                    return redirect("/master/bunga-simpanan/$id/edit")->with('error', 'Bulan dan tahun tidak boleh diubah');    
                }
            } else {
                return redirect("/master/bunga-simpanan/$id/edit")->with('error', 'Tanggal sudah lewat');
            }
        } else {
            return redirect("/master/bunga-simpanan/$id/edit")->with('error', 'Mohon isikan semua form');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bunga = BungaSimpanan::find($id);
        
                $bunga->delete();
        
                return redirect()->action("BungaSimpananController@index")->with('success', 'Berhasil menghapus bunga simpanan');
    }

    public function create_generate()
    {
        $masterbunga = Masterbunga::where("tanggal_mulai_berlaku", "<=", date("Y-m-d"))->orderBy("tanggal_mulai_berlaku", "DESC")->first();
        $status = DB::table("tb_trx_perhitungan_bunga_simpanan")->where("trx_bulan", date("m"))->where("trx_tahun", date("Y"))->count();
        $transaksi = DB::table("tb_trx_perhitungan_bunga_simpanan")->get();
        return view('proses_bunga', compact('masterbunga', 'status', 'transaksi'));
    }

    public function generate()
    {
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $bulan = date("m");
        $tahun = date("Y");
        $tanggal_sekarang = date_create("now");
        $jumlah_tanggal_bulan_ini = date("t", strtotime($tanggal_sekarang->format("Y-m-d")));
        $jumlah_tanggal_bulan_lalu = date("t", strtotime(date_sub($tanggal_sekarang, date_interval_create_from_date_string("$jumlah_tanggal_bulan_ini days"))->format("Y-m-d")));
        $tanggal_dua_bulan_lalu = date("Y-m-d", strtotime(date_sub($tanggal_sekarang, date_interval_create_from_date_string("$jumlah_tanggal_bulan_lalu days"))->format("Y-m-d")));
        $anggotas = Anggota::where("status_aktif", 1)->get();
        $bunga_simpanan = BungaSimpanan::whereDate('tanggal_mulai_berlaku', "<=", date("Y-m-d"))->orderBy("tanggal_mulai_berlaku", "DESC")->first();

        for($i = 0; $i < count($anggotas); $i++){
            $saldo = Simpanan::where("anggota_id", $anggotas[$i]->id)->whereDate("tanggal", "<=", $tanggal_dua_bulan_lalu)->sum("nominal_transaksi");
            $bunga = ($saldo * $bunga_simpanan->persentase) / 100;
            
            $simpanan = new Simpanan;
            $simpanan->anggota_id = $anggotas[$i]->id;
            $simpanan->tanggal = date('Y-m-d H:i:s');
            $simpanan->jenis_transaksi = 3;
            $simpanan->nominal_transaksi = $bunga;
            $simpanan->id_user = Session::get("user");

            $simpanan->save();
        }

        DB::table('tb_trx_perhitungan_bunga_simpanan')->insert([
            "trx_bulan" => $bulan,
            "trx_tahun" => $tahun,
            "tanggal_proses" => date('Y-m-d H:i:s'),
            "persentase_bunga" => $bunga_simpanan->persentase,
            "id_user" => Session::get("user")
        ]);

        return redirect()->action("BungaSimpananController@create_generate")->with("success", "Berhasil memproses bunga simpanan");
    }
}
