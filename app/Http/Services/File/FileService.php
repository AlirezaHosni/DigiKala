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
        $result = $file->move(public_path($this->getFinalFileDirectory()), $this->getFileName());

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

    public function deleteFile($filePath)
    {
        if (file_exists($filePath))
        {
            unlink($filePath);
        }
    }

    public function  deleteDirectoryAndFiles($directory): bool
    {
        if(!is_dir($directory))
        {
            return false;
        }

        // find files
        $files = glob($directory . DIRECTORY_SEPARATOR . '*' , GLOB_MARK);
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
