<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table ='tb_anggota';
    public $timestamps = false;
    protected $fillable = ['status_aktif'];
    public function ambil_user(){
    	return $this->belongsTo('App\User','user_id','id');
    }
}



