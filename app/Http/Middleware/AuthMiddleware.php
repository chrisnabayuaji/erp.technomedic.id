<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\App\AppModel;

class AuthMiddleware
{
  public function handle(Request $request, Closure $next): Response
  {
    if ($request->session()->get('login_st') != 1) {
      return redirect('/auth/login');
    }
    if (AppModel::getNav($request->input('n')) == null) {
      return redirect('/dashboard?n=' . md5('00'));
    }
    return $next($request);
  }
}
