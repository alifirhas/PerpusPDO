<?php

include "./class-autoload.inc.php";

$buku = new Buku();

$judul = $_POST['judul'];
$pengarang = $_POST['pengarang'];
$stok = $_POST['stok'];

$buku->store($judul, $pengarang, $stok);
