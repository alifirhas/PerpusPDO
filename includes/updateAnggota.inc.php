<?php

include "./class-autoload.inc.php";

$anggota = new Anggota();

$id = $_POST['id'];
$nama = $_POST['nama'];

$anggota->update($id, $nama);

header('Location: ../anggota.php');

