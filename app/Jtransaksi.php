<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jtransaksi extends Model
{
    protected $table ='tb_jenis_transaksi';
    protected $primarykey ='id';
    protected $fillable = ['transaksi','tipe'];
	public $timestamps = false;
}
