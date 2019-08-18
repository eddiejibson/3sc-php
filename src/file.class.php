<?php

include_once "FileInterface.php";

use \DateTimeInterface;

class File implements \Tsc\CatStorageSystem\FileInterface {

    protected $file;

    public function __construct($path) {
        if (!file_exists($path)) throw new Error("File does not exist");
        $this->file = $path;
    }

    public function getSize() {
        return filesize("../images/$this->file");
    }

    public function getModifiedTime() {
        $dt = new DateTime();
        return $dt->setTimestamp(filemtime($this->file));
    }

    public function getCreatedTime() {
        $dt = new DateTime();
        return $dt->setTimestamp(filectime($this->file)); //on windows ctime is creation time
    }

    public function getPath() {
        return realpath($this->file);
    }

    public function setModifiedTime(DateTimeInterface $modified) {
        return touch($this->file, $modified->getTimestamp());
    }

    public function setParentDirectory(DirectoryInterface $parent) { //will add var types later, just testing rn
        return rename($this->file, $parent->getPath() + "/$this->file"); //Guessing you mean move to within a directory (thus setting a parent directory)??
    }

    public function getParentDirectory() {
        return dirname($this->file);
    }

}
