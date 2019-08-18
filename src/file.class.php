<?php

include_once "FileInterface.php";

class File implements \Tsc\CatStorageSystem\FileInterface {
    public function __construct($file) {
        $this->file = "../images/$file";
        if (!file_exists($this->file)) {
            throw new Error("File does not exist");
        }
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
        return $dt->setTimestamp(filectime($this->file));
    }

    public function getPath() {
        return realpath($this->file);
    }

    public function setModifiedTime(DateTimeInterface $modified) {
        return touch($this->file, $modified->getTimestamp());
    }

}
