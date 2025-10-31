<?php

use Intervention\Image\ImageManager;

if (!function_exists('imageUpload')) {
    function imageUpload($file, $width = 100, $height = 100, $path = null)
    {
        if ($file) {
            $directory = public_path($path);
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // V3 Image Manager
            $manager = new ImageManager(new Intervention\Image\Drivers\Gd\Driver());

            $image = $manager->read($file);
            $image->resize($width, $height);

            $image->save($directory . '/' . $fileName);
            return url($path .'/'. $fileName);
        }
    }
}



if (!function_exists('usd_to_bdt')){
    function usd_to_bdt($amount){
        $conversionRate = $amount * 123;
        return $conversionRate;
    }
}