<?php

namespace App\Http\Controllers;
use App\User;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // public function dashboardadmin()
    // {
    //     if (Session::get('login')){
    //         if(Session::get('role')==1){
    //             return redirect('login/1');
    //         }
    //         else if(Session::get('role')==2){
    //             return redirect('login/2');
    //         }
    //         else{
    //             return view('dashboard');
    //         }
    //     }else{
    //         return view('login');
    //     }
    // }
    public function index()
    {
        $dataAdmin = DB::table('tb_users')
        ->get();
        return view('admin.daftarAdmin',compact('dataAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {   
        $validate = \Validator::make($req->all(),[
            'nik' => 'required',
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'user_role' => 'required',
        ]);
        if($validate->fails()){
            $karyawans = User::get();
            return redirect()->action("AdminController@create")->with('alert','harap dilengkapi');
        }
        $nik=$req->nik;
        $ambildata = User::where(['nik'=>$nik])->first();
        if($ambildata){
            return redirect()->back()->with('alert','NIK telah terdaftar');
        }
        else{
        $nik = $req->input('nik');
        $nama = $req->input('nama');
        $uname = $req->input('username');
        $pass = $req->input('password');
        $u_role=$req->input('user_role');
        $status=$req->input('status_aktif');

        DB::table('tb_users')->insert(
            [
            'nik' => $nik, 
            'nama' => $nama,
            'username' => $uname,
            'password' => $pass,
            'user_role' => $u_role,
            'status_aktif'=> $status
            ]
        );

        return redirect('/admin')->with('alert-success','Berhasil Menambahkan Data');
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
        $admin = DB::table('tb_users')
        ->where(['id'=>$id])
        ->get();
        return view('admin.editAdmin',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $nik = $req->input('nik');
        $nama = $req->input('nama');
        $uname = $req->input('username');
        $pass = $req->input('password');
        $u_role=$req->input('user_role');
        $status=$req->input('status_aktif');

        DB::table('tb_users')
        ->where('id',$id)
        ->update(
            [
                'nik' => $nik, 
                'nama' => $nama,
                'username' => $uname,
                'password' => $pass,
                'user_role' => $u_role,
                'status_aktif'=> $status,
            ]
        );

        return redirect('/admin')->with('alert-success','Berhasil Menambahkan Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       User::find($id)->update(['status_aktif' => 0]);
       return redirect("/admin")->with('alert-success','Berhasil Mengupdate Data');
    }
}


