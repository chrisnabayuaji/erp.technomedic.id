<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PegawaiModel extends Model
{
  static function allData()
  {
    $sql = "SELECT * FROM mst_pegawai";
    $result = DB::select($sql);
    return $result;
  }
}
