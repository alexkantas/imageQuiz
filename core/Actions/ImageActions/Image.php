<?php
/**
*Copyright 2017 Kantas.net
*
*Licensed under the Apache License, Version 2.0 (the "License");
*you may not use this file except in compliance with the License.
*You may obtain a copy of the License at
*
*    http://www.apache.org/licenses/LICENSE-2.0
*
*Unless required by applicable law or agreed to in writing, software
*distributed under the License is distributed on an "AS IS" BASIS,
*WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
*See the License for the specific language governing permissions and
*limitations under the License.
*/ 

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