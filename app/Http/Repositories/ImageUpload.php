<?php
/**
 * Created by PhpStorm.
 * User: Swastik
 * Date: 7/1/2019
 * Time: 10:15 AM
 */

namespace App\Http\Repositories;

use File;

class ImageUpload
{
    public function imageUpload($file, $path){

        $fileContents = $this->url_get_contents($file);

        $imageName =  date('mdYHis'). ".jpg";
        File::put(public_path() . $path . $imageName, $fileContents);
        return $imageName;
    }

    public function url_get_contents ($Url) {
        if (!function_exists('curl_init')){
            die('CURL is not installed!');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}