<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class IdentitasModel extends Model
{
  static function get()
  {
    $sql = "SELECT 
              a.*, b.pegawai_nm as kepala_nm
            FROM mst_identitas a
            LEFT JOIN mst_pegawai b ON a.kepala_id = b.pegawai_id";
    $result = DB::selectOne($sql);
    return $result;
  }

  static function store($d)
  {
    $result = DB::table('mst_identitas')
      ->where('identitas_id', 1)
      ->update($d);

    return $result;
  }
}
