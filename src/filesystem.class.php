<?php

namespace Tsc\CatStorageSystem;

include_once "FileSystemInterface.php";
include_once "file.class.php";
include_once "directory.class.php";

class FileSystem implements FileSystemInterface
{

    public function createFile(\Tsc\CatStorageSystem\FileInterface $file, \Tsc\CatStorageSystem\DirectoryInterface $parent)
    {
        touch($file->getPath()); //not really sure if this is what is meant, idk what else i'm meant to do with parent dir
        return $file->setParentDirectory($parent); //i'm guessing this is what is meant??
    }
    public function deleteFile(\Tsc\CatStorageSystem\FileInterface $file)
    {
        return unlink($file->getPath());
    }

    //guessing directory
    public function createDirectory(\Tsc\CatStorageSystem\DirectoryInterface $directory, \Tsc\CatStorageSystem\DirectoryInterface $parent = null)
    {
        $full = isset($parent) ? $parent->getPath() . "/" . $directory->getName() : $directory->getPath() . "/";
        if (!file_exists($full)) mkdir($full, 0777);
        return true;
    }

    public function deleteDirectory(\Tsc\CatStorageSystem\DirectoryInterface $directory)
    {
        return $this->deleteDirectoryRecursive($directory->getPath());
    }

    private function deleteDirectoryRecursive(string $path)
    {
        foreach ($this->getAllInDir($path) as $file) {
            is_file($file) ? unlink($file) : $this->deleteDirectoryRecursive($file);
        }
        return rmdir($path);
    }

    public function renameFile(\Tsc\CatStorageSystem\FileInterface $file, string $newName)
    {
        return rename($file->getPath(), $file->getParentDirectory() . "/" . $newName);
    }

    public function renameDirectory(\Tsc\CatStorageSystem\DirectoryInterface $directory, string $newName)
    {
        $newPath = dirname($directory->getPath()) . "/" . $newName;
        rename($directory->getPath(), $newPath);
        return $directory->setPath($newPath);
    }

    private function getDirectoryArr(string $path)
    {
        return glob(rtrim($path, "/") . "/*", GLOB_ONLYDIR);
    }

    private function getAllInDir(string $path)
    {
        return glob(rtrim($path, "/") . "/*");
    }

    private function getFileArr(string $path)
    {
        return array_filter($this->getAllInDir($path), "is_file");
    }

    public function getFileCount(\Tsc\CatStorageSystem\DirectoryInterface $directory)
    {
        return count($this->getFileArr($directory->getPath()));
    }

    public function getDirectoryCount(\Tsc\CatStorageSystem\DirectoryInterface $directory)
    {
        return count($this->getDirectoryArr($directory->getPath()));
    }

    private function directorySize(string $path)
    {
        $size = 0;
        foreach ($this->getAllInDir($path) as $file) {
            $size += is_file($file) ? filesize($file) : $this->directorySize($file); //this gets the size of subdirs too
        }
        return $size;
    }

    public function getDirectorySize(\Tsc\CatStorageSystem\DirectoryInterface $directory) //guessing this means including all files and subdirs??
    {
        return $this->directorySize($directory->getPath());
    }

    public function getDirectories(\Tsc\CatStorageSystem\DirectoryInterface $directory)
    {
        $arr = [];
        foreach ($this->getDirectoryArr($directory->getPath()) as $dir) {
            array_push($arr, new \Tsc\CatStorageSystem\Directory($dir));
        }
        return $arr;
    }

    public function getFiles(\Tsc\CatStorageSystem\DirectoryInterface $directory)
    {
        $arr = [];
        foreach ($this->getFileArr($directory->getPath()) as $file) {
            array_push($arr, new \Tsc\CatStorageSystem\File($file));
        }
        return $arr;
    }
}
