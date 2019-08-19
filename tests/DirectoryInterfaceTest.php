<?php

require_once __DIR__ . "/../src/directory.class.php";

use PHPUnit\Framework\TestCase;



class DirectoryInterfaceTest extends TestCase
{

    public function test_it_creates_a_new_instance()
    {
        $stub = $this->createMock(\Tsc\CatStorageSystem\DirectoryInterface::class);
        $this->assertTrue($stub instanceof \Tsc\CatStorageSystem\DirectoryInterface);
    }

    public function test_if_can_get_correct_directory()
    {
        $class = new \Tsc\CatStorageSystem\Directory("/");
        $this->assertTrue($class->getPath() == "/");
        $class->setPath("/etc");
        $this->assertTrue($class->getPath() == "/etc");
    }

    public function test_if_can_set_and_get_creation_times()
    {
        $class = new \Tsc\CatStorageSystem\Directory("/");
        $dt = new \DateTime();
        $class->setCreatedTime($dt);
        $this->assertTrue($class->getCreatedTime()->getTimestamp() == $dt->getTimestamp());
    }

    public function test_if_can_set_internal_names()
    {
        $class = new \Tsc\CatStorageSystem\Directory("/");
        $class->setName("test");
        $this->assertTrue($class->getName() == "test");
    }
}
