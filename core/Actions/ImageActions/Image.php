<?php

namespace Kantas_net\Actions\ImageActions ;

class Image {
    private static $image;

    public static function resizeSave($file,$newHeigth){
        try{
            $image = \Intervention\Image\ImageManagerStatic::make($file);
        } catch(\Intervention\Image\Exception\NotReadableException $e){
            echo "File is not valid!";
            die();
        }
        $image->resize(null,$newHeigth, function ($constraint) {
            $constraint->aspectRatio();
        });
        $date = (new \DateTime())->format('U'); //timestamp
        $path = "images/$date.jpg";
        $image->save("../".$path);
        return "/".$path;
    }
}