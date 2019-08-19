<?php

namespace Tsc\CatStorageSystem;

include_once "DirectoryInterface.php";

class Directory implements \Tsc\CatStorageSystem\DirectoryInterface
{

    protected $dir;
    protected $name;
    protected $created;

    public function __construct(string $dir)
    {
        $this->dir = $dir;
    }

    public function setName(string $name = null)
    {
        return $this->name = $name; //again assuming it meant internally?
    }

    public function getName()
    {
        return $this->name ?? null;
    }

    public function getPath()
    {
        return $this->dir ?? dir($this->dir)->path;
    }

    public function setCreatedTime(\DateTimeInterface $created)
    {
        $this->created = $created->getTimestamp();
    }

    public function getCreatedTime()
    {
        $dt = new \DateTime();
        $dt->setTimestamp($this->created ?? filectime($this->dir));
        return $dt;
    }

    private function ensureCreated()
    { //no longer in construct because apparently via this class you can create a directory that doesn't exist
        if (!file_exists($this->dir) || !is_dir($this->dir)) throw new \Error("Directory does not exist or it does and it's just not a directory");
    }

    public function setPath(string $path)
    { //again assuming this means move the directory thus changing the path and have it set?
        $res = true;
        if ($this->ensureCreated($this->dir)) {
            $res = rename($this->dir, $path); //Guessing you mean move to within a directory (thus setting a parent directory)??
        }
        $this->dir = $path;
        return $res;
    }
}
