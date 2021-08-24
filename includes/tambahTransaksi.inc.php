<?php

include "./class-autoload.inc.php";

$transaksi = new Transaksi();

$anggota = $_POST['anggota'];
$buku = $_POST['buku'];
$tglPinjam = $_POST['tglPinjam'];
$tglKembali = $_POST['tglKembali'];

echo "<br>" . $anggota;
echo "<br>" . $buku;
echo "<br>" . $tglPinjam;
echo "<br>" . $tglKembali;

$transaksi->store($anggota, $buku, $tglPinjam, $tglKembali);
