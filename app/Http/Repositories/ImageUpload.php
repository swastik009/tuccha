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
    public function uploader($file, $path = '/img/'){
        $fileContents = file_get_contents($file);
        $imageName =  $path . date('mdYHis'). ".jpg";
        //$imageURL = url($imageName); //save data in full site url
        File::put(public_path().$imageName, $fileContents); //puts in public folder
        return $imageName;
    }

//
}