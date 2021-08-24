<?php

include "./class-autoload.inc.php";

$anggota = new Anggota();

$nama = $_POST['nama'];

$anggota->store($nama);
