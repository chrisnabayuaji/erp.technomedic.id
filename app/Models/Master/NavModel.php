<?php

namespace App\Models\Master;

use App\Models\DbModel;
use Illuminate\Database\Eloquent\Model;

class NavModel extends Model
{
  static function loadDatatables()
  {
    $query = "SELECT * FROM app_nav a";
    $search = ['nav_id', 'nav_nm'];
    $where = null;
    $isWhere = null;

    $result = DbModel::datatablesQuery($query, $search, $where, $isWhere);
    return response()->json($result);
  }
}
