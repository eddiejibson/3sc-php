<?php

use Tsc\CatStorageSystem\FileSystem;

require_once __DIR__ . "/src/filesystem.class.php";
$fs = new Tsc\CatStorageSystem\FileSystem();
$dir = new Tsc\CatStorageSystem\Directory(__DIR__ . "/new_cats");
$fs->createDirectory($dir);
$file = new Tsc\CatStorageSystem\File(__DIR__ . "/cat.gif");
$fs->createFile($file, $dir);

$dir = new Tsc\CatStorageSystem\Directory(__DIR__ . "/images");
$files = $fs->getFiles($dir);
echo "There are a total of " . $fs->getFileCount($dir) . " cat related images within the /images directory.\n";
echo "There are a total of " . $fs->getDirectoryCount($dir) . " directories within the /images directory.\n";
foreach ($files as $file) {
    echo "\n" . $file->file . " has a size of " . $file->getSize() . " bytes. \n";
}
