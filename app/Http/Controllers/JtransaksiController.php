<?php

namespace App\Http\Controllers;

use App\Jtransaksi;
use Illuminate\Http\Request;

class JtransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Jtransaksi::get();
        return view('jenis.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis.form-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jenis = new Jtransaksi;
        $jenis->transaksi = $request->transaksi;
        $jenis->tipe = $request->tipe;
        $jenis->save();

        return redirect('/jenis');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jtransaksi  $jtransaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Jtransaksi $jtransaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jtransaksi  $jtransaksi
     * @return \Illuminate\Http\Response
     */
    public function edit($jtransaksi)
    {
        $datajenis = Jtransaksi::find($jtransaksi);
        return view('jenis.form-edit',compact('datajenis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jtransaksi  $jtransaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$jtransaksi)
    {
        Jtransaksi::find($jtransaksi)->update($request->all());
        return redirect('/jenis');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jtransaksi  $jtransaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy($jtransaksi)
    {
        Jtransaksi::find($jtransaksi)->delete();
        return redirect('/jenis')->with('alert-success','Data berhasil dihapus!');
    }
}
