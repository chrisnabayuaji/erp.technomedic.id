<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\MyController;
use App\Models\DbModel;
use App\Models\Master\JabatanModel;

class JabatanController extends MyController
{
  function __construct()
  {
    parent::__construct();
    $this->template = 'master/jabatan/';
  }

  function index()
  {
    $d = [];
    return $this->renderView($this->template . 'index', $d);
  }

  function formModal(string $id = null)
  {
    $d['main'] = DbModel::getData('mst_jabatan', ['jabatan_id' => $id]);
    $d['form_act'] = $this->uri . '/save/' . $id;
    return $this->renderView($this->template . 'formModal', $d);
  }

  function save(string $id = null)
  {
    $d = _post();
    if ($id == null) {
      if (DbModel::validId('mst_jabatan', 'jabatan_id', @$d['jabatan_id']) == true) {
        return response()->json(_response('20', $this->uri, $d));
      } else {
        $result = DbModel::insertData('mst_jabatan', $d);
        if ($result == false) {
          return response()->json(_response('11', $this->uri, $d));
        } else {
          return response()->json(_response('01', $this->uri, $d));
        }
      }
    } else {
      $result = DbModel::updateData('mst_jabatan', $d, ['jabatan_id' => $id]);
      if ($result == false) {
        return response()->json(_response('12', $this->uri, $d));
      } else {
        return response()->json(_response('02', $this->uri, $d));
      }
    }
  }

  function fullAccess()
  {
    return response()->json(_response('02', $this->uri));
  }

  public function delete(string $id)
  {
    $result = DbModel::deleteData('mst_jabatan', ['jabatan_id' => $id]);
    if ($result == false) {
      return response()->json(_response('13', $this->uri));
    } else {
      return response()->json(_response('03', $this->uri));
    }
  }

  public function ajaxDatatables()
  {
    return JabatanModel::loadDatatables();
  }
}
