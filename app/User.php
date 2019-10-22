<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table ='tb_users';
    protected $primarykey ='id';
    protected $fillable = ['nik','nama','username','password','user_role','status_aktif'];
    public $timestamps=false;
}
