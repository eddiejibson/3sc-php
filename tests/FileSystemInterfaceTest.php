<?php

require_once __DIR__ . "/../src/filesystem.class.php";
require_once __DIR__ . "/../src/directory.class.php";

use PHPUnit\Framework\TestCase;

class FileSystemInterfaceTest extends TestCase
{

    public function test_it_creates_a_new_instance()
    {
        $stub = $this->createMock(\Tsc\CatStorageSystem\FileSystemInterface::class);
        $this->assertTrue($stub instanceof \Tsc\CatStorageSystem\FileSystemInterface);
    }

    public function test_it_can_create_and_remove_directory()
    {
        $class = new \Tsc\CatStorageSystem\FileSystem();
        $dir = new \Tsc\CatStorageSystem\Directory(__DIR__ . "/test");
        $this->assertTrue($class->createDirectory($dir));
        $this->assertTrue(file_exists($dir->getPath()));
        $this->assertTrue($class->deleteDirectory($dir));
        $this->assertTrue(!file_exists($dir->getPath()));
    }

    public function test_it_can_get_correct_file_count()
    {
        $class = new \Tsc\CatStorageSystem\FileSystem();
        $dir = new \Tsc\CatStorageSystem\Directory(realpath(realpath("./images")));
        $this->assertTrue($class->getFileCount($dir) == 3);
    }

    public function test_it_can_get_correct_directory_count()
    {
        $class = new \Tsc\CatStorageSystem\FileSystem();
        $dir = new \Tsc\CatStorageSystem\Directory(realpath(realpath("./images")));
        $this->assertTrue($class->getDirectoryCount($dir) == 1);
    }
}
