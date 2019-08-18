<?php
namespace Tsc\CatStorageSystem;

class Directory implements \Tsc\CatStorageSystem\DirectoryInterface {

    protected $dir;

    public function __construct(string $dir) {
        if (!file_exists($path) || !is_dir($dir)) throw new Error("Directory does not exist or it does and it's just not a directory");
        $this->dir = $dir;
    }

    public function getPath() {
        return realpath($this->dir);
    }

    public function getCreatedTime() {
        return filectime($this->dir);
    }

    public function setPath(string $path) { //again assuming this means move the directory thus changing the path and have it set?
        return rename($this->dir, $path); //Guessing you mean move to within a directory (thus setting a parent directory)??
    }
}