<?php

namespace App\Models\Master;

use App\Models\DbModel;
use Illuminate\Database\Eloquent\Model;

class SekolahModel extends Model
{
  static function loadDatatables()
  {
    $query = "SELECT * FROM mst_sekolah a";
    $search = ['sekolah_id', 'sekolah_nm'];
    $where = null;
    $isWhere = null;

    $result = DbModel::datatablesQuery($query, $search, $where, $isWhere);
    return response()->json($result);
  }
}
