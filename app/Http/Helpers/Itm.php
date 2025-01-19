<?php

// RESPONSE

use Illuminate\Http\Request;

if (!function_exists('_response')) {
  function _response($code = null, $uri = null, $data = null)
  {
    $response = array(
      // TRUE
      '00' => array(
        'status' => true,
        'message' => 'Data berhasil diproses.',
        'uri' => $uri,
        'data' => $data,
      ),
      '01' => array(
        'status' => true,
        'message' => 'Data berhasil disimpan.',
        'uri' => $uri,
        'data' => $data,
      ),
      '02' => array(
        'status' => true,
        'message' => 'Data berhasil diubah.',
        'uri' => $uri,
        'data' => $data,
      ),
      '03' => array(
        'status' => true,
        'message' => 'Data berhasil dihapus.',
        'uri' => $uri,
        'data' => $data,
      ),
      '04' => array(
        'status' => true,
        'message' => 'Tindak Lanjut berhasil dibatalkan.',
        'uri' => $uri,
        'data' => $data,
      ),
      // FALSE
      '10' => array(
        'status' => false,
        'message' => 'Data gagal diproses !',
        'uri' => $uri,
        'data' => $data,
      ),
      '11' => array(
        'status' => false,
        'message' => 'Data gagal disimpan !',
        'uri' => $uri,
        'data' => $data,
      ),
      '12' => array(
        'status' => false,
        'message' => 'Data gagal diubah !',
        'uri' => $uri,
        'data' => $data,
      ),
      '13' => array(
        'status' => false,
        'message' => 'Data gagal dihapus !',
        'uri' => $uri,
        'data' => $data,
      ),
      '14' => array(
        'status' => false,
        'message' => 'Tindak Lanjut gagal dibatalkan !',
        'uri' => $uri,
        'data' => $data,
      ),
      '15' => array(
        'status' => false,
        'message' => 'File gagal diunggah',
        'uri' => $uri,
        'data' => $data,
      ),
      '20' => array(
        'status' => false,
        'message' => 'Terjadi duplikasi kode !',
        'uri' => $uri,
        'data' => $data,
      ),
      '29' => array(
        'status' => false,
        'message' => @$data['message'],
        'uri' => $uri,
        'data' => $data,
      ),
    );
    return $response[$code];
  }
}

if (!function_exists('_post')) {
  function _post($key = null)
  {
    $request = request();
    if ($key == null) {
      $post = $request->post();
      unset($post['_token'], $post['_is_ajax']);
    } else {
      $post = $request->input($key);
    }

    return $post;
  };
}

if (!function_exists('str_replace_between')) {
  function str_replace_between($str, $needle_start, $needle_end, $replacement)
  {
    $pos = strpos($str, $needle_start);
    $start = $pos === false ? 0 : $pos + strlen($needle_start);

    $pos = strpos($str, $needle_end, $start);
    $end = $pos === false ? strlen($str) : $pos;

    return substr_replace($str, $replacement, $start, $end - $start);
  }
}
