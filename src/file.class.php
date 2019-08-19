<?php

namespace Tsc\CatStorageSystem;

include_once "FileInterface.php";

use \DateTimeInterface;

class File implements \Tsc\CatStorageSystem\FileInterface
{

    public $file;
    protected $size;
    public $name;

    public function __construct(string $path)
    {
        $this->file = $path;
    }

    public function setName(string $name = null)
    {
        return $this->name = $name; //assuming this didn't mean literally setting the file name? again internally?
    }

    public function getName()
    {
        return $this->name ?? null;
    }

    public function setSize(int $size)
    {
        return $this->size = $size;
    }

    public function getSize()
    {
        return $this->size ?? filesize($this->file);
    }

    public function getModifiedTime()
    {
        $dt = new \DateTime();
        return $dt->setTimestamp(filemtime($this->file));
    }

    public function setCreatedTime(DateTimeInterface $created)
    {
        return $this->created = $created->getTimestamp();
    }

    public function getCreatedTime()
    {
        $dt = new \DateTime();
        return $dt->setTimestamp($this->created) ?? $dt->setTimestamp(filectime($this->file)); //on windows ctime is creation time
    }

    public function getPath()
    {
        return $this->file;
    }

    public function setModifiedTime(DateTimeInterface $modified)
    {
        return touch($this->file, $modified->getTimestamp());
    }

    public function setParentDirectory(DirectoryInterface $parent)
    { //will add var types later, just testing rn
        return rename($this->file, $parent->getPath() . "/" . basename($this->file)); //Guessing you mean move to within a directory (thus setting a parent directory)??
    }

    public function getParentDirectory()
    {
        return dirname($this->file);
    }
}
