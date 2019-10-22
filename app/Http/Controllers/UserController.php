<?php

namespace App\Http\Controllers;

use App\User;
use App\ModelUser;
use App\Anggota;
use App\Simpanan;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(){
        if (Session::get('login')){
            if(Session::get('role')==1){
                return redirect('/dashboard');
            }
            else if(Session::get('role')==2){
                return redirect('/dashboard');
            }
            else{
                return redirect('dashboard');
            }
        }
        return view('login');
    }

    public function signin(Request $req){
           $username = $req->username;
           $password = $req->password;

           $ceklogin = User::where(['username'=>$username])->first();

           if(count($ceklogin)>0){
               if($password==$ceklogin->password && $username==$ceklogin->username){
                   Session::put('id',$ceklogin->id);
                   Session::put('username',$ceklogin->username);
                   Session::put('password',$ceklogin->password);
                   Session::put('nama',$ceklogin->nama);
                   Session::put('role',$ceklogin->user_role);
                   Session::put('login', TRUE);
               $users = ModelUser::get();
                   if(Session::get('role')==1){
                       return redirect('dashboard');
                   }
                   else if(Session::get('role')==2){
                       return redirect('dashboard');
                   }
                   else{
                       return redirect('dashboard');
                   }

               }else{
                   return view('login')->with('alert','Username atau Password salah!');
               }
           }else{
               return view('login');
           }

       }
           


    public function register(Request $request){
        return view('admin.register');
    }


    public function dashboard(){
        if(!Session::get('login')){
            return redirect('login')->with('alert','Kamu harus login dulu');
        }

        else{
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $bulan = date("m");
        $tahun = date("Y");
        $nasabah = Anggota::where('status_aktif',1)->get()->count();
        $simpanan=Simpanan::whereYear('tanggal', $tahun)->whereMonth("tanggal", $bulan)->count();
        for($i = 0; $i < count($nasabah); $i++){
            $tabungan = Simpanan::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->wherein("jenis_transaksi", [1,3])->sum("nominal_transaksi");
        }
        for($i = 0; $i < count($nasabah); $i++){
            $penarikan = Simpanan::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->where("jenis_transaksi", 2)->sum("nominal_transaksi");
        }
        return view('dashboard',compact("nasabah","simpanan","tabungan","penarikan"));
        }
    }

    public function logout(){

        Session::flush();

        return redirect('/')->with('alert','Kamu sudah logout');

    }

    public function cariNasabah(Request $request){
        $idNasabah=$request->id;
        $data=Anggota::where(['no_anggota'=>$idNasabah])->first();
        if(count($data)>0){
            $id1=$data->id;
            $ambildata=Anggota::find($id1);
            return view('anggota.carinasabah',compact('ambildata'));
        }
        else{
            return redirect()->back()->with('alert','Data tidak ditemukan');
        }
        
    }
    public function cariAdmin(Request $request){
        if(!Session::get('nama')){
            return redirect('/')->with('alert','Kamu harus login dulu');
        }
        else{
            $nikAdmin=$request->id;
            $forms=User::where(['nik'=>$nikAdmin])->first();
            if(count($forms)>0){
                $id1=$forms->id;
                $ambildata=User::find($id1);
                return view('admin.cariAdmin',compact('ambildata'))->with('alert-success','Data Berhasil Ditemukan');
            }
            else{
                return redirect()->back()->with('alert','Data tidak ditemukan');
            }
        }
    }
    

}
