<?php

include "./class-autoload.inc.php";

$buku = new Buku();

$id = $_POST['id'];
$judul = $_POST['judul'];
$pengarang = $_POST['pengarang'];
$stok = $_POST['stok'];

$buku->update($id, $judul, $pengarang, $stok);

header('Location: ../buku.php');

