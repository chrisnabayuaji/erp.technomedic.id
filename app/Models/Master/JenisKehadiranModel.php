<?php

namespace App\Models\Master;

use App\Models\DbModel;
use Illuminate\Database\Eloquent\Model;

class JenisKehadiranModel extends Model
{
  static function loadDatatables()
  {
    $query = "SELECT * FROM mst_jenis_kehadiran a";
    $search = ['jeniskehadiran_id', 'jeniskehadiran_nm'];
    $where = null;
    $isWhere = null;

    $result = DbModel::datatablesQuery($query, $search, $where, $isWhere);
    return response()->json($result);
  }
}
