<?php
namespace App\Helpers;

class ImgHelper
{
    public static function getImgName($src)
    {
        return "/storage/uploads/" . $src;
    }
}
?>