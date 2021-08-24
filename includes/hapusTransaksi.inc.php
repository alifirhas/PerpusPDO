<?php

include "./class-autoload.inc.php";

$transaksi = new Transaksi();

$id = $_POST['id'];

$transaksi->destroy($id);
