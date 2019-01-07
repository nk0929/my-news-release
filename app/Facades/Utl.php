<?php // app/Facades/utl.php
/**
* Utlのファサードクラス
* 松田追加
*/
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
* Bladeのビューで利用できるユーティリティ関数を保持するクラス
*/
class Utl extends Facade {
  protected static function getFacadeAccessor() {
    //return ['isNullOrEmpty', 'getS3ImagePath', 'rmS3ImagePrefix'];
    return 'utl';
  }
}
