<?php

require_once __DIR__ . "/../src/file.class.php";

use PHPUnit\Framework\TestCase;

class FileInterfaceTest extends TestCase
{

    public function test_it_creates_a_new_instance()
    {
        $stub = $this->createMock(\Tsc\CatStorageSystem\FileInterface::class);
        $this->assertTrue($stub instanceof \Tsc\CatStorageSystem\FileInterface);
    }

    public function test_it_can_get_and_set_modification_times_on_real_files()
    {
        $class = new \Tsc\CatStorageSystem\File(__DIR__ . "/../images/cat_1.gif");
        $dt = new \DateTime();
        $class->setModifiedTime($dt);
        $this->assertTrue($class->getModifiedTime()->getTimestamp() == $dt->getTimestamp());
    }


    public function test_it_can_get_correct_directory()
    {
        $class = new \Tsc\CatStorageSystem\File(__DIR__);
        $this->assertTrue($class->getPath() == __DIR__);
    }

    public function test_it_can_get_correct_parent_directory()
    {
        $class = new \Tsc\CatStorageSystem\File(__DIR__);
        $this->assertTrue($class->getParentDirectory() == realpath(__DIR__ . "/.."));
    }
}
