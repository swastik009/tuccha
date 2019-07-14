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
    public function imageUpload($file, $path = '/img/'){

        $fileContents = file_get_contents($file);

        $imageName =  date('mdYHis'). ".jpg";
        File::put(public_path() . $path . $imageName, $fileContents);
        return $imageName;
    }

//
}