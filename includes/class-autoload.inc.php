<?php
// file auto loader
spl_autoload_register(function ($namaClass){
    $ds = DIRECTORY_SEPARATOR;
    $dir = __DIR__ ;
    $path = "./classes/";
    $extensi = ".class.php";
    $namaClass = $namaClass;

    $namaFile = $path . $namaClass . $extensi;

    if (!file_exists($namaFile)) {
        $namaFile = ".".$namaFile;
        if (!file_exists($namaFile)) {
            return false;
        }
    }

    include_once $namaFile;

});