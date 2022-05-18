<?php


namespace App\Http\Services\File;


class FileService extends FileToolsService
{

    public function moveToPublic($file)
    {
        // set file
        $this->setFile($file);

        // execute file
        $this->provider();

        // save file
        $result = $file->move(public_path($this->getFinalFileDirectory()), $this->getFinalFileName());

        return $result ? $this->getFileAddress() : false ;
    }

    public function moveToStorage($file)
    {
        // set file
        $this->setFile($file);

        // execute file
        $this->provider();

        // save file
        $result = $file->move(storage_path($this->getFinalFileDirectory()), $this->getFileName());

        return $result ? $this->getFileAddress() : false ;
    }

    public function deleteFile($filePath, $storage=false)
    {
        if ($storage)
        {
//            delete this if make an error
            if (file_exists(storage_path($filePath)))
            {
                unlink(storage_path($filePath));
                return true;
            }else
                return false;
        }

        if (file_exists($filePath))
        {
            unlink($filePath);
            return true;
        }else
            return false;
    }

}
