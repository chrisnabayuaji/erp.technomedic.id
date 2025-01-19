<?php

namespace App\Http\Controllers;

use App\Models\App\AppModel;

abstract class Controller
{
  var $identitas;
  public function __construct()
  {
    $this->identitas = AppModel::getIdentitas();
  }
}
