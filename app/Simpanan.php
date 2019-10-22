<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    protected $table = "tb_simpanan";
    public $timestamps = false;

    public function ambil_member(){
    	return $this->belongsTo('App\Anggota','anggota_id','id');
    }
}
