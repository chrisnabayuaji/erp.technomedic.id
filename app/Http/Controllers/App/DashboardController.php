<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\MyController;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends MyController
{
  public function index(): View
  {
    return $this->renderView('app/dashboard/index');
  }
}
