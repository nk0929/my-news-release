<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Utl;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  // 松田追加ここから
  /**
  * 画像ファイル名が「画像無し」又は空かの真偽値を返す
  *
  * @param  画像ファイル名
  * @return 画像ファイル名が「画像無し」又は空かの真偽値
  */
  protected function isNoImage($filename) {

    return Utl::isNullOrEmpty($filename) || (0 == strcmp(env('NO_IMAGE_FILENAME'), $filename));
  }

  /**
  * 画像ファイルをAWS S3にアップロードする
  *
  * @param  リクエストから取り出した画像オブジェクト
  * @return 一意となる画像ファイル名
  */
  protected function storeImage($imageObj) {

    $imageName = '';
    if (!Utl::isNullOrEmpty($imageObj)) {
      $imageName = Storage::disk(env('FILESYSTEM_DRIVER'))->putFile(env('IMAGE_URL_PREFIX'), $imageObj, 'public');
    }
    return $imageName;
  }

  /**
  * ストレージの画像ファイルを削除する
  *
  * @param  削除する画像のファイル名
  * @return void
  */
  protected function deleteImage($filename) {

    if (!Utl::isNullOrEmpty($filename) && !self::isNoImage($filename)) {
      $filePath = env('IMAGE_URL_PREFIX') . '/' . $filename;
      Storage::disk(env('FILESYSTEM_DRIVER'))->delete($filePath);
    }
  }

  /**
  * ストレージの画像ファイルを入れ替える
  *
  * @param  リクエストから取り出した画像オブジェクト
  * @param  削除する画像のファイル名
  * @return 入れ替えた画像の一意となるファイル名
  */
  protected function swapImage($imageObj, $filename) {

    // 画像を保存
    $imageName = self::storeImage($imageObj);

    // 保存に成功した場合、入れ替え対象の画像を削除する
    if (!Utl::isNullOrEmpty($imageName) && !self::isNoImage($filename)) {
      self::deleteImage($filename);
    }
    return $imageName;
  }
  // 松田追加ここまで
}
