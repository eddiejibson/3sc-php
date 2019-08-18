<?php

namespace Tsc\CatStorageSystem;

use PHPUnit\Framework\TestCase;

class FileSystemInterfaceTest extends TestCase {

    public function test_it_creates_a_new_instance() {

        $stub = $this->createMock(FileSystemInterface::class);
        $this->assertTrue($stub instanceof FileSystemInterface);
    }
}
