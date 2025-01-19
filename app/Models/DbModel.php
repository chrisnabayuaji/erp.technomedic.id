<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DbModel extends Model
{
  static function allData($table, $params = array())
  {
    $result = DB::table($table)->where($params)->get()->all();
    return $result;
  }

  static function getData($table, $params = array())
  {
    $result = DB::table($table)->where($params)->get()->first();
    return $result;
  }

  static function validId($table, $field, $value)
  {
    $return = self::getData($table, [$field => $value]);
    if ($return != false) {
      return true;
    } else {
      return false;
    }
  }

  static function insertData($table, $d)
  {
    $d['created_at'] = date('Y-m-d H:i:s');
    $d['created_by'] = session('pegawai_nm');

    try {
      DB::table($table)->insert($d);
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  static function updateData($table, $d, $where)
  {
    $d['updated_at'] = date('Y-m-d H:i:s');
    $d['updated_by'] = session('pegawai_nm');

    try {
      DB::table($table)->where($where)->update($d);
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  static function deleteData($table, $where)
  {
    try {
      DB::table($table)->where($where)->delete();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public static function rawData($init, $query, $params = [])
  {
    switch ($init) {
      case 'result_array':
        return DB::select($query, $params);
        break;
      case 'row_array':
        return DB::selectOne($query, $params);
        break;
      case 'num_rows':
        return DB::select($query, $params);
        break;
      default:
        return DB::selectOne($query, $params);
        break;
    }
  }
  static function datatablesQuery($query, $keyword, $where, $iswhere = null)
  {
    // Params
    $d = _post();

    $_search_value = @$d['search']['value'];
    $_length = @$d['length'];
    $_start = @$d['start'];
    $_order_field = @$d['order'][0]['column'];
    $_order_ascdesc = @$d['order'][0]['dir'];

    // 
    // Ambil data yang di ketik user pada textbox pencarian
    $search = htmlspecialchars($_search_value);
    $search = strtolower($search);
    // 
    // Ambil data limit per page
    $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_length}");
    // 
    // Ambil data start
    $start = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_start}");
    //
    // Lower Keywoard
    if (is_array($keyword)) {
      foreach ($keyword as $k => $v) {
        $keyword[$k] = "LOWER(" . $v . ")";
      }
    }

    $strWhere = " WHERE ";

    if ($iswhere != null) {
      if (strtolower(substr(@$iswhere, 0, 3)) == "and" || @$iswhere == "") {
        $strWhere .= '1 = 1 ';
      } else {
        $strWhere .= ' ';
      }

      $strWhere .= $iswhere;
    } else {
      $strWhere .= '1 = 1 ';
    }

    if ($where != null) {
      $setWhere = array();
      foreach ($where as $key => $value) {
        $setWhere[] = $key . "='" . $value . "'";
      }
      $fwhere = implode(' AND ', $setWhere);
      $strWhere .= " AND " . $fwhere;
    }

    // Untuk mengambil nama field yg menjadi acuan untuk sorting
    $strOrder = " ORDER BY " . @$d['columns'][$_order_field]['data'] . " " . $_order_ascdesc;

    $queryData = $query . $strWhere;
    $queryAllRecords = str_replace_between($queryData, 'SELECT', 'FROM', ' COUNT(1) AS count ');

    // Searching by keyword
    if ($keyword != null && @count($keyword) > 0) {
      $strWhereKeyword = $strWhere;
      $strKeyword = implode(" LIKE '%" . $search . "%' OR ", $keyword) . " LIKE '%" . $search . "%'";
      $strWhereKeyword .= " AND (" . $strKeyword . ") ";

      $queryData = $query . $strWhereKeyword . $strOrder;
      $queryFiltered = $query . $strWhereKeyword;
    } else {
      $queryData = $query . $strWhere . $strOrder;
      $queryFiltered = $query . $strWhere;
    }

    $queryData .= " LIMIT " . $limit . " OFFSET " . $start;

    $data = self::rawData('result_array', $queryData);
    $recordsTotal = self::rawData('row_array', $queryAllRecords)->count;

    if ($keyword != null && @count($keyword) > 0) {
      $queryRecordsFiltered = str_replace_between($queryFiltered, 'SELECT', 'FROM', ' COUNT(1) AS count ');
      $recordsFiltered = self::rawData('row_array', $queryRecordsFiltered)->count;
    } else {
      $recordsFiltered = $recordsTotal;
    }

    $callback = array(
      'draw' => $d['draw'],
      'recordsTotal' => $recordsTotal,
      'recordsFiltered' => $recordsFiltered,
      'data' => $data
    );

    return $callback;
  }
}
