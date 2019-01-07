<?php
namespace App\Http\Components;

use Auth;

/**
 * Utlファサードの処理実装クラス
 * 松田追加
 */
class Utl
{
    /**
     * null か 空文字であるかの真偽値を返す
     *
     * @param  オブジェクト
     * @return null か 空文字である場合はtrue、それ以外の場合はfalse
     */
    public function isNullOrEmpty($object)
    {
        return is_null($object) || ('' == $object);
    }

    /**
     * 文字列が等価であるかの真偽値を返す
     *
     * @param  比較対象String１
     * @param  比較対象String２
     * @return 文字列が等価ならtrue、それ以外の場合はfalse
     */
    public function isSameStr($str1, $str2)
    {
        return !is_null($str1) && !is_null($str2) && (0 == strcmp($str1, $str2));
    }

    /**
     * ログインしているかの真偽値を返す
     *
     * @param  void
     * @return ログインしているかの真偽値
     */
    public function isLogin()
    {
        return Auth::check();
    }

    /**
     * 管理者でログインしているかの真偽値を返す
     *
     * @param  void
     * @return 管理者でログインしているかの真偽値
     */
    public function isAdmin()
    {
        return self::isLogin() && 9 === Auth::id();
    }

    /**
     * 画像無しの場合のファイル名を取得
     *
     * @param  void
     * @return 画像無しの場合のファイル名
     */
    public function getNoImageFilename()
    {
        return env('NO_IMAGE_FILENAME');
    }

    /**
     * 画像無しの場合のファイル名を取得
     *
     * @param  void
     * @return 画像無しの場合のファイル名
     */
    public function getNoImage2Filename()
    {
        return env('NO_IMAGE_FILENAME2');
    }

    /**
     * 画像無しの場合のファイル名かの真偽値を返す
     *
     * @param  画像ファイル名
     * @return 画像無しの場合のファイル名かの真偽値
     */
    public function isNoImage($filename)
    {
        return self::isSameStr(self::getNoImageFilename(), $filename);
    }

    /**
     * StorageTypeがs3であるかの真偽値を返す
     *
     * @param  void
     * @return StorageTypeがs3であるかの真偽値
     */
    public function isS3()
    {
        return self::isSameStr(env('FILESYSTEM_DRIVER'), env('FILESYSTEM_DRIVER_TYPE_S3'));
    }

    /**
     * 画像へのフルパス取得
     *
     * @param  画像ファイル名
     * @return 画像ファイルへのフルパス
     *         画像ファイル名が空の場合は、画像無しのファイルパスを返す
     */
    public function getImagePath($filename)
    {

        if (self::isS3()) {
            $ret = env('AWS_S3_URL') . '/' . env('IMAGE_URL_PREFIX') . '/' . (self::isNullOrEmpty($filename) ? self::getNoImageFilename() : $filename);
        } else {
            $ret = asset('storage/image/' . $filename);
        }
        return $ret;
    }

    /**
     * 画像へのフルパス取得
     *
     * @param  画像ファイル名
     * @return 画像ファイルへのフルパス
     *         画像ファイル名が空の場合は、画像無しのファイルパスを返す
     */
    public function getProfileImagePath($filename)
    {

        if (self::isS3()) {
            $ret = env('AWS_S3_URL') . '/' . env('IMAGE_URL_PREFIX') . '/' . (self::isNullOrEmpty($filename) ? self::getNoImage2Filename() : $filename);
        } else {
            $ret = asset('storage/image/' . $filename);
        }
        return $ret;
    }

    /**
     * JavaScriptによる確認画面付きの<a />タグを生成する
     * putComfirmJsとペアで使うことで、画面に確認画面付きのリンクを実装する
     *
     * @param $cssClass:スタイルシートのクラス名
     * @param $funcName:JavaScript関数名
     * @param $url:OKボタンで遷移するurl
     * @param <a />タグの表示ラベル
     * @return void
     */
    public function confirmATag($cssClass, $funcName, $url, $lavel)
    {
        $aTag = "<a ";
        if (!self::isNullOrEmpty($cssClass)) {
            $aTag .= "class=\"" . $cssClass . "\" ";
        }
        $aTag .= "href=\"javascript:void(0);\"" . " onclick=\"" . $funcName . "('" . $url . "'); return false;\">" . $lavel . "</a>\n";
        echo $aTag;
    }

    /**
     * 確認画面を表示するJavaScriptを画面に出力する
     * confirmATagとペアで使うことで、画面に確認画面付きのリンクを実装する
     *
     * @param  $funcName:JavaScript関数名
     * @param  $msg:確認メッセージ
     * @return void
     */
    public function putConfirmJs($funcName, $msg)
    {
        $script =
            'function ' . $funcName . "(\$url) {\n" .
            "    if(window.confirm('" . $msg . "')) {\n" .
            "      location.href = \$url;\n" .
            "    }\n" .
            "  }\n";
        echo $script;
    }
}
