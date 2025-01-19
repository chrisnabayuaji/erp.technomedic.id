<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\MyController;
use App\Models\DbModel;
use App\Models\Master\IdentitasModel;
use App\Models\Kepegawaian\PegawaiModel;

class IdentitasController extends MyController
{
  function __construct()
  {
    parent::__construct();
    $this->template = 'master/identitas/';
  }

  function index()
  {
    $d['main'] = IdentitasModel::get();
    $d['all_pegawai'] = PegawaiModel::allData();

    $d['form_act'] = $this->uri . '/save';
    return $this->renderView($this->template . 'index', $d);
  }

  function save()
  {
    $d = _post();
    $result = DbModel::updateData('mst_identitas', $d, ['identitas_id' => 1]);

    if ($result == false) {
      return response()->json(_response('12', $this->uri, $d));
    } else {
      return response()->json(_response('02', $this->uri, $d));
    }
  }
}
