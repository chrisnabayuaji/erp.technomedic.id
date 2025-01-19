<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\MyController;
use App\Models\DbModel;
use App\Models\Master\NavModel;

class NavController extends MyController
{
  function __construct()
  {
    parent::__construct();
    $this->template = 'master/nav/';
  }

  function index()
  {
    $d = [];
    return $this->renderView($this->template . 'index', $d);
  }

  function formModal(string $id = null)
  {
    $d['main'] = DbModel::getData('app_nav', ['nav_id' => $id]);
    $d['parent'] = DbModel::allData('app_nav', ['deleted_st' => '0', 'active_st' => '1']);
    $d['form_act'] = $this->uri . '/save/' . $id;
    return $this->renderView($this->template . 'formModal', $d);
  }

  function save(string $id = null)
  {
    $d = _post();
    if ($id == null) {
      if (DbModel::validId('app_nav', 'nav_id', @$d['nav_id']) == true) {
        return response()->json(_response('20', $this->uri, $d));
      } else {
        $result = DbModel::insertData('app_nav', $d);
        if ($result == false) {
          return response()->json(_response('11', $this->uri, $d));
        } else {
          return response()->json(_response('01', $this->uri, $d));
        }
      }
    } else {
      $result = DbModel::updateData('app_nav', $d, ['nav_id' => $id]);
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
    $result = DbModel::deleteData('app_nav', ['nav_id' => $id]);
    if ($result == false) {
      return response()->json(_response('13', $this->uri));
    } else {
      return response()->json(_response('03', $this->uri));
    }
  }

  public function ajaxDatatables()
  {
    return NavModel::loadDatatables();
  }
}
