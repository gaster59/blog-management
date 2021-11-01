<?php

/**
 * @param string $str
 *
 * @return string
 */
function stripVN($str)
{
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);

    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    return $str;
}

/**
 * @param string $folder folder update in public
 * @param string name name's control in form
 *
 * @return string
 */
function uploadImage($request, $folder, $name)
{
    $originName = $request->file($name)->getClientOriginalName();
    $fileName   = pathinfo($originName, PATHINFO_FILENAME);
    $extension  = $request->file($name)->getClientOriginalExtension();
    $fileName   = 'post_' . time() . '.' . $extension;

    $pathImages = public_path($folder);
    if (!file_exists($pathImages)) {
        // create folder and file index.html
        mkdir($pathImages);
        $disk = Storage::build([
            'driver' => 'local',
            'root'   => public_path($folder),
        ]);
        $disk->put('index.html', 'deny all');
    }

    $request->file($name)->move(public_path($folder), $fileName);
    return $fileName;
}

function __isBase64String($string)
{
    // Check if there is no invalid character in string
    if (!preg_match('/^(?:[data]{4}:(text|image|application)\/[a-z]*)/', $string)) {
        return false;
    } else {
        return true;
    }
}

function saveProductImageBase64($base64String, $request, $folder, $initAvatar = '')
{
    try {
        if (!__isBase64String($base64String)) {
            return $initAvatar;
        }
        list($extension, $content) = explode(';', $base64String);
        $tmpExtension              = 'jpg';
        $fileName                  = 'post_' . time() . '.' . $tmpExtension;
        $content                   = explode(',', $content)[1];

        $storage = Storage::build([
            'driver' => 'local',
            'root'   => public_path($folder),
        ]);
        $pathImages = public_path($folder . '/index.html');
        if (!file_exists($pathImages)) {
            // create folder and file index.html
            $storage->put('index.html', 'deny all');
        }
        $storage->put($fileName, base64_decode($content));
        $pathImage = public_path($folder . '/' . $fileName);
        return $fileName;
    } catch (Exception $ex) {
        \Log::error($ex->getMessage());
        return '';
    }
}
