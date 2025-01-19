<?php

namespace App\Models\Master;

use App\Models\DbModel;
use Illuminate\Database\Eloquent\Model;

class DivisiModel extends Model
{
  static function loadDatatables()
  {
    $query = "SELECT * FROM mst_divisi a";
    $search = ['divisi_id', 'divisi_nm'];
    $where = null;
    $isWhere = null;

    $result = DbModel::datatablesQuery($query, $search, $where, $isWhere);
    return response()->json($result);
  }
}
