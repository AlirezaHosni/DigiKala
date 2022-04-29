<?php


namespace App\Http\Services\Image;


use Intervention\Image\Facades\Image;
use League\Flysystem\Config;

class ImageService extends ImageToolsService
{

    public function save($image)
    {
        // set image
        $this->image = $image;

        // execute image
        $this->provider();

        // save image
        $result = Image::make($image->getRealPath())->save(public_path($this->getImageAddress()), null, $this->getImageFormat()); // laravel and modern php
        // $_FILES['image']['tmp_name']  old php

        return $result ? $this->getImageAddress() : false ;
    }

    public function fitAndSave($image, $width, $height)
    {
        // set image
        $this->image = $image;

        // execute image
        $this->provider();

        // save image
        $result = Image::make($image->getRealPath())->fit($width, $height)->save(public_path($this->getImageAddress()), null, $this->getImageFormat()); // laravel and modern php
        // $_FILES['image']['tmp_name']  old php

        return $result ? $this->getImageAddress() : false ;
    }

    public function createAndSave($image)
    {
        // get data from config
        $imageSizes = Config('image.index-image-sizes');

        //set image
        $this->setImage($image);

        // set directory
        $this->getImageDirectory() ?? $this->setImageDirectory(date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d'));
        $this->setImageDirectory($this->getImageDirectory() . DIRECTORY_SEPARATOR . time());

        // set name
        $this->getImageName() ?? $this->setImageName(time());
        $imageName = $this->getImageName();

        $indexArray = [];
        foreach ($imageSizes as $sizeAliases => $imageSize)
        {
            // create and set this size name
            $currentImageName = $imageName . '-' . $sizeAliases;
            $this->setImageName($currentImageName);

            // execute image
            $this->provider();

            // save image
            $result = Image::make($image->getRealPath())->fit($imageSize['width'], $imageSize['height'])
                ->save(public_path($this->getImageAddress()), null, $this->getImageFormat());

            if ($result)
                $indexArray[$sizeAliases] = $this->getImageAddress();
            else
                return false;
        }

        $images['indexArray'] = $indexArray;
        $images['directory'] = $this->getFinalImageDirectory();
        $images['currentImage'] = Config('image.default-current-index-image');

        return $images;
    }

    public function deleteImage($imagePath)
    {
        if (file_exists($imagePath))
        {
            unlink($imagePath);
        }
    }

    public function deleteIndex($image)
    {
        $directory = public_path($image['directory']);
        $this->deleteDirectoryAndFiles($directory);
    }

    public function  deleteDirectoryAndFiles($directory): bool
    {
        if(!is_dir($directory))
        {
            return false;
        }

        // find images
        $files = glob($directory . DIRECTORY_SEPARATOR . '*' . GLOB_MARK);
        foreach ($files as $file)
        {
            if (is_dir($file))
            {
                $this->deleteDirectoryAndFiles($directory);
            }else
            {
                unlink($file);
            }
        }
        return rmdir($directory);
    }
}
